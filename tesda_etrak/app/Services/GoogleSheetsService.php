<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\Sheet;

class GoogleSheetsService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->spreadsheetId = env('LIST_OF_GRADUATES_ID');

        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/credentials.json'));
        $this->client->addScope(Sheets::SPREADSHEETS);

        $this->service = new Sheets($this->client);
    }

    public function updateRows($range, array $values) 
    {
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->update($this->spreadsheetId, $range, $body, $params);
    }

    public function appendRows($range, array $values) 
    {
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->append($this->spreadsheetId, $range, $body, $params);
    }

    public function clearSheet($sheetName) {
        $this->service->spreadsheets_values->clear($this->spreadsheetId, $sheetName, new Sheets\ClearValuesRequest());
    }
}
