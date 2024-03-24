<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class AzureDevOpsController extends Controller
{
    public function getWorkItem($workItemId)
    {
        $personalAccessToken = 'afusblapcqkcxzi4avuzchsgl4uxfy274xgd2757kdeevxcstpia';
        $organization = 'ExProtectionProduects';
        $project = 'SRACO';
        // $workItemID = '56052';
        $apiVersion = '7.1'; // Or another version if necessary

        $client = new Client();

        try {
            $response = $client->request('GET', "https://dev.azure.com/{$organization}/{$project}/_apis/wit/workitems/{$workItemId}?api-version={$apiVersion}", [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(":{$personalAccessToken}"),
                    'Accept' => 'application/json',
                ],
            ]);

            $workItem = json_decode($response->getBody()->getContents(), true);

            // Process the $workItem as needed
            return response()->json($workItem);
        } catch (GuzzleException $e) {
            // Handle the error appropriately
            return response()->json(['error' => 'Request failed: ' . $e->getMessage()], 500);
        }
    }
}