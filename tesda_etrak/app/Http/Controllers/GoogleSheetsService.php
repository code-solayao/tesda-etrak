<?php

namespace App\Http\Controllers;

use Google\Service\Sheets;
use Google_Client;
use Illuminate\Http\Request;

class GoogleSheetsService extends Controller
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setApplicationName('Laravel-Google Sheets');
        $this->client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $this->client->setAuthConfig(storage_path('app/credentials.json'));
        $this->client->setAccessType('offline');

        $this->service = new Sheets($this->client);
        // kulang pa
    }
}
