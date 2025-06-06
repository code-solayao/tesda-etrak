<?php

namespace App\Console\Commands;

use App\Models\Graduate;
use Carbon\Carbon;
use Google\Service\Sheets;
use Google_Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class ImportSheetsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sheets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Google Sheets data into local MySQL database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sheets data import starts...');

        // Google Client setup
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets to MySQL Import');
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $service = new Sheets($client);

        // $spreadsheetId = env('EMPLOYMENT_MONITORING_SYSTEM_ID');
        $spreadsheetId = '100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q';
        $range = 'List of Graduates';

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
        $values = $response->getValues();
        $this->info('Rows found: ' . count($values));

        if (empty($values)) {
            $this->error('No data found.');
            return;
        }

        // First row headers
        $headers = array_map('strtolower', $values[0]);
        $rows = array_slice($values, 1);

        // Chunk rows
        $chunks = array_chunk($rows, 1000);

        $errorNum = 1;
        foreach ($chunks as $chunk) {
            $this->info('Processing chunk...');

            foreach ($chunk as $row) {
                $normalizedRow = array_pad($row, count($headers), null);
                $normalizedRow = array_slice($normalizedRow, 0, count($headers));
                $data = array_combine($headers, $normalizedRow);

                $validator = Validator::make($data, [
                    'ln' => ['required', 'string', 'max:255'], 
                    'fn' => ['required', 'string', 'max:255'], 
                    'name' => ['required', 'string', 'max:255'], 
                    'email address' => ['nullable', 'email', 'max:255']
                ]);

                if ($validator->fails()) {
                    $this->warn("($errorNum) Skipping row due to validation: " . json_encode($data) . "\n");
                    $errorNum++;
                    continue;
                }

                $sanitized = [
                    'district' => trim($data['district'] ?? ''), 
                    'city' => trim($data['city'] ?? ''), 
                    'tvi' => trim($data['name of tvi'] ?? ''), 
                    'qualification_title' => trim($data['qualification title'] ?? ''), 
                    'sector' => trim($data['sector'] ?? ''), 
                    'last_name' => trim($data['ln']), 
                    'first_name' => trim($data['fn']), 
                    'middle_name' => trim($data['mi'] ?? ''), 
                    'extension_name' => trim($data['ext'] ?? ''), 
                    'full_name' => trim($data['name']), 
                    'sex' => trim($data['sex'] ?? ''), 
                    'birthdate' => trim($data['date of birth'] ?? ''), 
                    'contact_number' => trim($data['contact number'] ?? ''), 
                    'email' => trim($data['email address'] ?? ''), 
                    'address' => trim($data['address'] ?? ''), 
                    'scholarship_type' => trim($data['scholarship type'] ?? ''), 
                    'training_status' => trim($data['training status'] ?? ''), 
                    'assessment_result' => trim($data['assessment result'] ?? ''), 
                    'employment_before_training' => trim($data['employment before training'] ?? ''), 
                    'occupation' => trim($data['occupation'] ?? ''), 
                    'employer_name' => trim($data['name of employer'] ?? ''), 
                    'employment_type' => trim($data['employment type'] ?? ''), 
                    'work_address' => trim($data['address of employer'] ?? ''), 
                    'date_hired' => trim($data['date hired'] ?? ''), 
                    'allocation' => trim($data['allocation'] ?? ''), 
                    'verification_means' => trim($data['means of verification'] ?? ''), 
                    'verification_date' => trim($data['date of verification'] ?? ''), 
                    'verification_status' => trim($data['status of verification'] ?? ''), 
                    'follow_up_date_1' => trim($data['follow-up date'] ?? ''), 
                    'response_status' => trim($data['status of responses'] ?? ''), 
                    'not_interested_reason' => trim($data['reasons (not interested)'] ?? ''), 
                    'referral_status' => trim($data['referal status'] ?? ''), 
                    'company_name' => trim($data['name of company'] ?? ''), 
                    'company_address' => trim($data['address (city)'] ?? ''), 
                    'job_title' => trim($data['job title'] ?? ''), 
                    'employment_status' => trim($data['employment status'] ?? ''), 
                    'hired_date' => trim($data['date of hired'] ?? ''), 
                    'not_hired_reason' => trim($data['remarks'] ?? ''), 
                    'count' => trim($data['count'] ?? ''), 
                    'no_of_graduates' => trim($data['no. of graduates'] ?? ''), 
                    'no_of_employed' => trim($data['no. of employed'] ?? ''), 
                    'verification' => trim($data['verification'] ?? ''), 
                    'job_vacancies' => trim($data['job vacancies (verification)'] ?? ''), 
                    'remarks' => trim($data['follow-up remarks'] ?? ''), 
                    'application_status' => trim($data['application status (proceed or not for job opening)'] ?? '')
                ];

                $sanitized['birthdate'] = $this->dateFormat1($sanitized['birthdate']);
                $sanitized['date_hired'] = $this->dateFormat2($sanitized['date_hired']);
                $sanitized['verification_date'] = $this->dateFormat1($sanitized['verification_date']);
                $sanitized['follow_up_date_1'] = $this->dateFormat1($sanitized['follow_up_date_1']);
                $sanitized['hired_date'] = $this->dateFormat3($sanitized['hired_date']);

                Graduate::create([
                    'district' => $sanitized['district'], 
                    'city' => $sanitized['city'], 
                    'tvi' => $sanitized['tvi'], 
                    'qualification_title' => $sanitized['qualification_title'], 
                    'sector' => $sanitized['sector'], 
                    'last_name' => $sanitized['last_name'], 
                    'first_name' => $sanitized['first_name'], 
                    'middle_name' => $sanitized['middle_name'], 
                    'extension_name' => $sanitized['extension_name'], 
                    'full_name' => $sanitized['full_name'], 
                    'sex' => $sanitized['sex'], 
                    'birthdate' => $sanitized['birthdate'], 
                    'contact_number' => $sanitized['contact_number'], 
                    'email' => $sanitized['email'], 
                    'address' => $sanitized['address'], 
                    'scholarship_type' => $sanitized['scholarship_type'], 
                    'training_status' => $sanitized['training_status'], 
                    'assessment_result' => $sanitized['assessment_result'], 
                    'employment_before_training' => $sanitized['employment_before_training'], 
                    'occupation' => $sanitized['occupation'], 
                    'employer_name' => $sanitized['employer_name'], 
                    'employment_type' => $sanitized['employment_type'], 
                    'work_address' => $sanitized['work_address'], 
                    'date_hired' => $sanitized['date_hired'], 
                    'allocation' => $sanitized['allocation'], 
                    'verification_means' => $sanitized['verification_means'], 
                    'verification_date' => $sanitized['verification_date'], 
                    'verification_status' => $sanitized['verification_status'], 
                    'follow_up_date_1' => $sanitized['follow_up_date_1'], 
                    'follow_up_date_2' => null, 
                    'response_status' => $sanitized['response_status'], 
                    'not_interested_reason' => $sanitized['not_interested_reason'], 
                    'referral_status' => $sanitized['referral_status'], 
                    'referral_date' => null, 
                    'no_referral_reason' => null, 
                    'invalid_contact' => null, 
                    'company_name' => $sanitized['company_name'], 
                    'company_address' => $sanitized['company_address'], 
                    'job_title' => $sanitized['job_title'], 
                    'application_status' => $sanitized['application_status'], 
                    'withdrawn_reason' => null, 
                    'employment_status' => $sanitized['employment_status'], 
                    'hired_date' => $sanitized['hired_date'], 
                    'submitted_documents_date' => null, 
                    'interview_date' => null, 
                    'not_hired_reason' => $sanitized['not_hired_reason'], 
                    'count' => $sanitized['count'], 
                    'no_of_graduates' => $sanitized['no_of_graduates'], 
                    'no_of_employed' => $sanitized['no_of_employed'], 
                    'verification' => $sanitized['verification'], 
                    'job_vacancies' => $sanitized['job_vacancies'], 
                    'remarks' => $sanitized['remarks']
                ]);
            }
        }

        $this->info('Sheets data import completed.');
    }

    // Format: 08/05/1930
    public function dateFormat1($date) {
        $formattedDate = $date;

        if (strlen($date) == 10 && str_contains($date, '/')) {
            $date = Carbon::createFromFormat('m/d/Y', $date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }

    // Format: 08-05-1930
    public function dateFormat2($date) {
        $formattedDate = $date;

        if (strlen($date) == 10 && str_contains($date, '-')) {
            $date = Carbon::createFromFormat('m-d-Y', $date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }

    // Format: 05-Aug-1930
    public function dateFormat3($date) {
        $formattedDate = $date;

        if (strlen($date) == 11 && str_contains($date, '-')) {
            $date = Carbon::parse($date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }
}
