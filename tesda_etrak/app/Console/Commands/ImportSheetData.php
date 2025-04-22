<?php

namespace App\Console\Commands;

use App\Services\GoogleSheetsService;
use Illuminate\Console\Command;

class ImportSheetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sheet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from Google Sheets to MySQL';

    /**
     * Execute the console command.
     */
    public function handle(GoogleSheetsService $service)
    {
        $spreadsheetId = 'sheet-id-ko';
        $range = 'List of Graduates!A2:D';

        $data = $service->getSheetData($spreadsheetId, $range);

        foreach ($data as $row) {
            // Eloquent models > DB
        }

        $this->info('Data imported successfully.');
    }
}
