<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Sector;
use GuzzleHttp\Client;
use App\Models\Company;
use App\Models\AzureIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;

class AzureDevOpsController extends Controller
{
    public function index()
    {
        $organization = 'ExProtectionProduects';
        $personalAccessToken = env('AZURE_DEVOPS_PAT');
        $url = "https://dev.azure.com/{$organization}/_apis/projects?api-version=7.1-preview.4";

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(":{$personalAccessToken}"),
        ])->get($url);

        $projectsData = $response->json()['value'];

        $projects = collect($projectsData)->map(function ($project) {
            return [
                'id' => $project['name'], // Use project name as the value
                'name' => $project['name'], // Display name in the dropdown
            ];
        })->all();

        $azure_issues = AzureIssue::paginate(12);
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        $companies = Company::all();

        return view('pages.azure_issues', compact('azure_issues', 'sectors', 'sectorsWithEntities', 'companies', 'projects'));
    }


    public function getWorkItem($workItemId, $projectName)
    {
        $personalAccessToken = env('AZURE_DEVOPS_PAT');
        $organization = 'ExProtectionProduects';
        $apiVersion = '7.1-preview.3';

        $client = new Client();
        try {
            $response = $client->request('GET', "https://dev.azure.com/{$organization}/{$projectName}/_apis/wit/workitems/{$workItemId}?api-version={$apiVersion}", [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(":{$personalAccessToken}"),
                    'Accept' => 'application/json',
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                return json_decode($response->getBody()->getContents(), true);
            } else {
                return null;
            }
        } catch (GuzzleException $e) {
            return null;
        }
    }

    public function addIssue(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'issue_number' => 'required|numeric',
        ]);
        $projectName = $request->input('company_id');
        $issueNumber = $request->input('issue_number');
        $workItem = $this->getWorkItem($issueNumber, $projectName);
        if ($workItem) {
            $azureProjectName = $workItem['fields']['System.TeamProject'] ?? null;

            // Validate that the work item belongs to the selected project
            if ($azureProjectName !== $projectName) {
                return back()->with('error', 'The issue number does not exist in the selected project.');
            }

            $issue_type             = strip_tags($workItem['fields']['System.WorkItemType'] ?? null);
            $title                  = strip_tags($workItem['fields']['System.Title']);
            $description            = strip_tags($workItem['fields']['Microsoft.VSTS.TCM.ReproSteps'] ?? null);
            $createdBy              = strip_tags($workItem['fields']['System.CreatedBy']['displayName'] ?? null);
            $resolvedBy             = strip_tags($workItem['fields']['Microsoft.VSTS.Common.ResolvedBy']['displayName'] ?? null);
            $status                 = strip_tags($workItem['fields']['System.State'] ?? null);
            $priority               = strip_tags($workItem['fields']['Microsoft.VSTS.Common.Priority'] ?? null);
            $discipline             = strip_tags($workItem['fields']['Microsoft.VSTS.Common.Discipline'] ?? null);
            $teams                  = strip_tags($workItem['fields']['Custom.Teams'] ?? null);
            $source                 = strip_tags($workItem['fields']['Custom.Source'] ?? null);
            $WorkedTime             = strip_tags($workItem['fields']['Custom.WorkedTime'] ?? null);
            $descriptionOfClose     = strip_tags($workItem['fields']['Custom.DescriptionofClose'] ?? 'Not closed yet');
            $createdDate            = strip_tags($workItem['fields']['System.CreatedDate'] ?? null);

            $azureIssue = new AzureIssue([
                'work_item_id'          => $issueNumber,
                'project'               => $azureProjectName,
                'issue_type'            => $issue_type,
                'title'                 => $title,
                'description'           => $description,
                'created_by'            => $createdBy,
                'resolved_by'           => $resolvedBy,
                'status'                => $status,
                'priority'              => $priority,
                'discipline'            => $discipline,
                'teams'                 => $teams,
                'source'                => $source,
                'worked_time'           => $WorkedTime,
                'description_of_close'  => $descriptionOfClose,
                'created_date'          => $createdDate,
            ]);
            $azureIssue->save();
            return redirect()->route('azure_issues')->with('message', 'Issue added successfully');
        } else {
            return redirect()->route('azure_issues')->with('error', 'Failed to fetch issue details from Azure DevOps');
        }
    }
}
