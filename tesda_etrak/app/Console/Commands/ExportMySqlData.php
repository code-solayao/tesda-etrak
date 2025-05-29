<?php

namespace App\Console\Commands;

use App\Models\Graduate;
use Google\Client;
use Google\Service\Sheets;
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

        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->addScope(Sheets::SPREADSHEETS);
        $service = new Sheets($client);

        // $spreadsheetId = env('EXPORT_SHEET_ID');
        $spreadsheetId = '1-PlAbP1Y0dgqUEmblx3atGrjkkPWkOxrTE1qglkwfvM';
        $range = 'List of Graduates';

        Graduate::chunk(1000, function ($rows) use ($service, $spreadsheetId, $range) {
            $values = [];

            foreach ($rows as $row) {
                $values[] = [
                    $row->district, 
                    $row->city, 
                    $row->tvi, 
                    $row->qualification_title, 
                    $row->sector, 
                    $row->last_name, 
                    $row->first_name, 
                    $row->middle_name, 
                    $row->extension_name, 
                    $row->full_name, 
                    $row->sex, 
                    $row->birthdate, 
                    $row->contact_number, 
                    $row->email, 
                    $row->address, 
                    $row->scholarship_type, 
                    $row->training_status, 
                    $row->assessment_result, 
                    $row->employment_before_training, 
                    $row->occupation, 
                    $row->employer_name, 
                    $row->employment_type, 
                    $row->work_address, 
                    $row->date_hired, 
                    $row->allocation, 
                    $row->verification_means, 
                    $row->verification_date, 
                    $row->verification_status, 
                    $row->follow_up_date_1, 
                    $row->response_status, 
                    $row->not_interested_reason, 
                    $row->referral_status, 
                    $row->company_name, 
                    $row->company_address, 
                    $row->job_title, 
                    $row->employment_status, 
                    $row->hired_date, 
                    $row->not_hired_reason, 
                    $row->count, 
                    $row->no_of_graduates, 
                    $row->no_of_employed, 
                    $row->verification, 
                    $row->job_vacancies, 
                    $row->remarks, 
                    $row->application_status
                ];
            }

            $body = new Sheets\ValueRange([
                'values' => $values
            ]);

            $params = ['valueInputOption' => 'RAW'];

            $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

            $this->info(count($values) . ' rows appended. ');
        });

        $this->info('MySQL database export complete.');
        return Command::SUCCESS;
    }
}
