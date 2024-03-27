<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Sector;
use GuzzleHttp\Client;
use App\Models\Company;
use App\Models\AzureIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\QueryException;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use GuzzleHttp\Exception\GuzzleException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

            DB::beginTransaction();
            try{
                $issue_type             = strip_tags(html_entity_decode($workItem['fields']['System.WorkItemType'] ?? null));
                $title                  = strip_tags($workItem['fields']['System.Title']);
                $description            = strip_tags(html_entity_decode($workItem['fields']['Microsoft.VSTS.TCM.ReproSteps'] ?? null));
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
                DB::commit();
                return redirect()->route('azure_issues')->with('message', 'Issue added successfully');
            }catch(QueryException $e){
                DB::rollBack();
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    return back()->with('error', 'The issue number already exists in the selected project.');
                }
            }
        } else {
            return redirect()->route('azure_issues')->with('error', 'Failed to fetch issue details from Azure DevOps');
        }
    }

    public function exportIssues()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headings
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Project');
        $sheet->setCellValue('C1', 'Type');
        $sheet->setCellValue('D1', 'Title');
        $sheet->setCellValue('E1', 'Description');
        $sheet->setCellValue('F1', 'Created By');
        $sheet->setCellValue('G1', 'Resolved By');
        $sheet->setCellValue('H1', 'status');
        $sheet->setCellValue('I1', 'priority');
        $sheet->setCellValue('J1', 'discipline');
        $sheet->setCellValue('K1', 'teams');
        $sheet->setCellValue('L1', 'source');
        $sheet->setCellValue('M1', 'Worked Time');
        $sheet->setCellValue('N1', 'Description of Close');
        $sheet->setCellValue('O1', 'Created Date');
        $sheet->setCellValue('P1', 'Created At');

        $headingStyle = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FF002060',
                ],
            ],
            'font' => [
                'bold' => true,
                'color' => ['argb' => Color::COLOR_WHITE],
            ],
        ];
        $sheet->getStyle('A1:P1')->applyFromArray($headingStyle);

        // Retrieve issues from database
        $issues = AzureIssue::all();
        $row = 2;

        // Iterate through the issues to fill the spreadsheet
        foreach ($issues as $issue) {
            $sheet->setCellValue('A' . $row, $issue->work_item_id);
            $sheet->setCellValue('B' . $row, $issue->project);
            $sheet->setCellValue('C' . $row, $issue->issue_type);
            $sheet->setCellValue('D' . $row, $issue->title);
            $sheet->setCellValue('E' . $row, $issue->description);
            $sheet->setCellValue('F' . $row, $issue->created_by);
            $sheet->setCellValue('G' . $row, $issue->resolved_by);
            $sheet->setCellValue('H' . $row, $issue->status);
            $sheet->setCellValue('I' . $row, $issue->priority);
            $sheet->setCellValue('J' . $row, $issue->discipline);
            $sheet->setCellValue('K' . $row, $issue->teams);
            $sheet->setCellValue('L' . $row, $issue->source);
            $sheet->setCellValue('M' . $row, $issue->worked_time);
            $sheet->setCellValue('N' . $row, $issue->description_of_close);
            $sheet->setCellValue('O' . $row, $issue->created_date);
            $sheet->setCellValue('P' . $row, $issue->created_at);
            $row++;
        }

        // Redirect output to a client’s web browser (Excel5)
        $writer = new Xlsx($spreadsheet);

        $fileName = "azure_issues_export_" . date('Ymd') . ".xlsx";
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create a StreamedResponse to download file
        $response = new StreamedResponse(
            function () use ($writer, $temp_file) {
                $writer->save($temp_file);
                readfile($temp_file);
                unlink($temp_file);
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );

        return $response;
    }

    public function delete($workItemId){
        $issue = AzureIssue::findOrFail($workItemId);
        $issue->delete();
        return redirect()->route('azure_issues')->with('message', 'Issue deleted successfully');
    }
}