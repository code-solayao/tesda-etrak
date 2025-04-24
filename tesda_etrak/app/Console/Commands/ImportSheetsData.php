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

        $spreadsheetId = env('GOOGLE_SHEET_ID');
        $range = 'List of Graduates!A1:AS2';

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

        foreach ($chunks as $chunk) {
            $this->info('Processing chunk...');
            $this->info('--------------------------------');

            foreach ($chunk as $row) {
                $normalizedRow = array_pad($row, count($headers), null);
                $normalizedRow = array_slice($normalizedRow, 0, count($headers));
                $data = array_combine($headers, $normalizedRow);
                $all_keys = array_keys($data);
                $all_values = array_values($data);
                for ($i = 0; $i < count($all_keys); $i++) {
                    $this->info("{$all_keys[$i]} = {$all_values[$i]}");
                }
                $this->info('--------------------------------');
                continue;

                // Validate row
                $validator = Validator::make($data, [
                    'district' => ['nullable', 'string', 'max:50'], 
                    'city' => ['nullable', 'string', 'max:50'], 
                    'name of tvi' => ['nullable', 'string', 'max:255'], 
                    'qualification title' => ['nullable', 'string', 'max:255'], 
                    'sector' => ['nullable', 'string', 'max:255'], 
                    'ln' => ['required', 'string', 'max:255'], 
                    'fn' => ['required', 'string', 'max:255'], 
                    'mi' => ['nullable', 'string', 'max:255'], 
                    'ext' => ['nullable', 'string', 'max:50'], 
                    'name' => ['required', 'string', 'max:255'], 
                    'sex' => ['nullable', 'string', 'max:50'], 
                    'date of birth' => ['nullable', 'string', 'max:50'], 
                    'contact number' => ['nullable', 'string', 'min:13', 'max:16'], 
                    'email address' => ['nullable', 'email', 'max:255'], 
                    'address' => ['nullable', 'string', 'max:255'], 
                    'scholarship type' => ['nullable', 'string', 'max:50'], 
                    'training status' => ['nullable', 'string', 'max:50'], 
                    'assessment result' => ['nullable', 'string', 'max:255'], 
                    'employment before training' => ['nullable', 'string', 'max:50'], 
                    'occupation' => ['nullable', 'string', 'max:255'], 
                    'name of employer' => ['nullable', 'string', 'max:255'], 
                    'employment type' => ['nullable', 'string', 'max:255'], 
                    'address of employer' => ['nullable', 'string', 'max:255'], 
                    'date hired' => ['nullable', 'string', 'max:50'], 
                    'allocation' => ['nullable', 'string', 'max:50'], 
                    'means of verification' => ['nullable', 'string', 'max:50'], 
                    'date of verification' => ['nullable', 'string', 'max:50'], 
                    'status of verification' => ['nullable', 'string', 'max:50'], 
                    'follow-up date' => ['nullable', 'string', 'max:50'], 
                    'status of responses' => ['nullable', 'string', 'max:50'], 
                    'reasons (not interested)' => ['nullable', 'string', 'max:255'], 
                    'referal status' => ['nullable', 'string', 'max:10'], 
                    'name of company' => ['nullable', 'string', 'max:255'], 
                    'address (city)' => ['nullable', 'string', 'max:255'], 
                    'job title' => ['nullable', 'string', 'max:255'], 
                    'employment status' => ['nullable', 'string', 'max:255'], 
                    'date of hired' => ['nullable', 'string', 'max:50'], 
                    'remarks' => ['nullable', 'string', 'max:50'], 
                    'count' => ['nullable', 'string', 'max:10'], 
                    'no. of graduates' => ['nullable', 'string', 'max:10'], 
                    'no. of employed' => ['nullable', 'string', 'max:10'], 
                    'verification' => ['nullable', 'string', 'max:50'], 
                    'job vacancies (verification)' => ['nullable', 'string', 'max:10'], 
                    'follow-up remarks' => ['nullable', 'string', 'max:255'], 
                    'application status (proceed or not for job opening)' => ['nullable', 'string', 'max:255']
                ]);

                if ($validator->fails()) {
                    $this->warn('Skipping row due to validation: ' . json_encode($data));
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

                $birthdate = $sanitized['birthdate'] == '' ? '' : Carbon::parse($sanitized['birthdate']);
                $date_hired = $sanitized['date_hired'] == '' ? '' : Carbon::parse($sanitized['date_hired']);
                $verification_date = $sanitized['verification_date'] == '' ? '' : Carbon::parse($sanitized['verification_date']);
                $follow_up_date_1 = $sanitized['follow_up_date_1'] == '' ? '' : Carbon::parse($sanitized['follow_up_date_1']);
                $hired_date = $sanitized['hired_date'] == '' ? '' : Carbon::parse($sanitized['hired_date']);
                $sanitized['birthdate'] = $birthdate == '' ? '' : $birthdate->format('Y-m-d');
                $sanitized['date_hired'] = $date_hired == '' ? '' : $date_hired->format('Y-m-d');
                $sanitized['verification_date'] = $verification_date == '' ? '' : $verification_date->format('Y-m-d');
                $sanitized['follow_up_date_1'] = $follow_up_date_1 == '' ? '' : $follow_up_date_1->format('Y-m-d');
                $sanitized['hired_date'] = $hired_date == '' ? '' : $hired_date->format('Y-m-d');

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
}
