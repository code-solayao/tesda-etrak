<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

class GoogleSheetsService 
{
    public function getSheetData($spreadsheetId, $range) {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->addScope(Sheets::SPREADSHEETS_READONLY);

        $service = new Sheets($client);
        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        return $response->getValues();
    }
}