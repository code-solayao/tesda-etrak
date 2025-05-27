<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;

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
        $this->spreadsheetId = env('EXPORT_SHEET_ID');

        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/credentials.json'));
        $this->client->addScope(Sheets::SPREADSHEETS);
        $this->client->setApplicationName("Laravel Google Sheets Service");

        $this->service = new Sheets($this->client);
    }

    public function clearSheet($sheetName) 
    {
        $this->service->spreadsheets_values->clear(
            $this->spreadsheetId,
            $sheetName,
            new \Google\Service\Sheets\ClearValuesRequest()
        );
    }

    public function updateRows($range, array $values) 
    {
        $body = new \Google\Service\Sheets\ValueRange([
            'values' => $values
        ]);

        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->update(
            $this->spreadsheetId, $range, $body, $params
        );
    }
}
