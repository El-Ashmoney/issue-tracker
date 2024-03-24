<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AzureDevOpsController extends Controller
{
    public function getWorkItem($workItemId)
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
}
