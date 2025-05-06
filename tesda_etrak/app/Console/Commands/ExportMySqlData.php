<?php

namespace App\Console\Commands;

use App\Http\Controllers\GoogleSheetsService;
use App\Models\Graduate;
use Illuminate\Console\Command;

class ExportMySqlData extends Command
{
    protected $sheetsService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export local MySQL database into Google Sheets';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('MySQL database export starts...');

        $spreadsheetId = env('GOOGLE_SHEET_ID');
        $range = 'Exported Data';

        Graduate::chunk(1000, function($rows) use ($spreadsheetId, $range) {
            $values = [];

            foreach ($rows as $row) {
                $values[] = [
                    $row->column1, 
                    // dagdagan pa syempre
                ];
            }

            // kulang pa
            $this->info(count($values) . ' rows appended. ');
        });

        $this->info('MySQL database export complete.');
        return Command::SUCCESS;
    }

    public function __construct(GoogleSheetsService $sheetsService)
    {
        parent::__construct();
        $this->sheetsService = $sheetsService;
    }
}
