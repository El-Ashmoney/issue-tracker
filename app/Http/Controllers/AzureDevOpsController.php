<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Sector;
use GuzzleHttp\Client;
use App\Models\Company;
use App\Models\AzureIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;

class AzureDevOpsController extends Controller
{
    public function index()
    {
        $azure_issues = AzureIssue::paginate(12);
        $sectors = Sector::all();
        $sectorsWithEntities = Sector::with('entity')->get()->groupBy('entity.name');
        $companies = Company::all();
        return view('pages.azure_issues', compact('azure_issues', 'sectors', 'sectorsWithEntities', 'companies'));
    }
    public function sracoGetWorkItem($workItemId)
    {
        $personalAccessToken = env('AZURE_DEVOPS_PAT');
        $organization = 'ExProtectionProduects';
        $project = 'SRACO';
        $apiVersion = '7.1';
        $client = new Client();
        try {
            $response = $client->request('GET', "https://dev.azure.com/{$organization}/{$project}/_apis/wit/workitems/{$workItemId}?api-version={$apiVersion}", [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(":{$personalAccessToken}"),
                    'Accept' => 'application/json',
                ],
            ]);
            $workItem = json_decode($response->getBody()->getContents(), true);
            return response()->json($workItem);
        } catch (GuzzleException $e) {
            return response()->json(['error' => 'Request failed: ' . $e->getMessage()], 500);
        }
    }

    public function rnrGetWorkItem($workItemId)
    {
        $personalAccessToken = env('AZURE_DEVOPS_PAT');
        $organization = 'ExProtectionProduects';
        $project = 'RNR Project';
        $apiVersion = '7.1-preview.3';
        $client = new Client();
        try {
            $response = $client->request('GET', "https://dev.azure.com/{$organization}/{$project}/_apis/wit/workitems/{$workItemId}?api-version={$apiVersion}", [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(":{$personalAccessToken}"),
                    'Accept' => 'application/json',
                ],
            ]);
            $workItem = json_decode($response->getBody()->getContents(), true);
            return response()->json($workItem);
        } catch (GuzzleException $e) {
            return response()->json(['error' => 'Request failed: ' . $e->getMessage()], 500);
        }
    }
}