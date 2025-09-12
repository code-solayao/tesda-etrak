<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Carbon\Carbon;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Http\Request;

class JobVacanciesController extends Controller
{
    public function index(Request $request) {
        $vacancies = JobVacancy::select('company_name', 'contact_details', 'no_of_vacancies', 'deployment_location')
        ->orderBy('id', 'desc')->get();
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        return view('job-vacancies.index', compact('vacancies', 'search', 'search_category'));
    }

    public function search_vacancies(Request $request) 
    {
        $vacancies = null;
        $search = null;
        $search_category = null;

        if (empty($request)) {
            $vacancies = JobVacancy::select()->orderBy('id', 'desc')->paginate(10);
            return view('job-vacancies.index', compact('vacancies', 'search', 'search_category'));
        }

        $search = $request->input('search');
        $search_category = $request->input('search_category');

        switch ($search_category) {
            case "Name of Company":
                $vacancies = JobVacancy::where(function($query) use ($search) {
                    $query->where('company_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Contact Details":
                $vacancies = JobVacancy::where(function($query) use ($search) {
                    $query->where('contact_details', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "No. of Vacancies":
                $vacancies = JobVacancy::where(function($query) use ($search) {
                    $query->where('no_of_vacancies', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Deployment Location":
                $vacancies = JobVacancy::where(function($query) use ($search) {
                    $query->where('deployment_location', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            default:
                if ($search == '') {
                    $vacancies = JobVacancy::select('company_name', 'contact_details', 'no_of_vacancies', 'deployment_location')
                    ->orderBy('id', 'desc')->paginate(10);
                }
                else {
                    $vacancies = JobVacancy::where(function($query) use ($search) {
                        $query->where('company_name', 'LIKE', "%$search%")
                        ->orWhere('contact_details', 'LIKE', "%$search%")
                        ->orWhere('no_of_vacancies', 'LIKE', "%$search%")
                        ->orWhere('deployment_location', 'LIKE', "%$search%");
                    })->orderBy('id', 'desc')->paginate(10);
                }
        }

        return view('job-vacancies.index', compact('vacancies', 'search', 'search_category'));
    }

    public function import_data() 
    {
        logger()->info('Initialising Google Sheets data import.');

        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $service = new Sheets($client);

        $spreadsheetId = '100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q';
        $sheet = 'Job Vacancies';

        if (empty($spreadsheetId)) {
            logger()->error('Google Sheets data import failed: Spreadsheet ID is missing.');
            return 'Spreadsheet ID is not configured.';
        }

        $response = $service->spreadsheets_values->get($spreadsheetId, $sheet);
        $values = $response->getValues();
        logger()->info("Rows found: " . count($values));

        if (empty($values)) {
            logger()->warning('Sheet is empty');
            return 'No data found';
        }

        // First row headers
        $headers = array_map('strtolower', $values[0]);
        $rows = array_slice($values, 1);

        // Chunk rows
        $chunks = array_chunk($rows, 100);

        $errorNum = 1;
        foreach ($chunks as $chunk) {
            logger()->info('Processing chunk...');

            foreach ($chunk as $row) {
                $normalizedRow = array_pad($row, count($headers), null);
                $normalizedRow = array_slice($normalizedRow, 0, count($headers));
                $data = array_combine($headers, $normalizedRow);

                $validator = \Illuminate\Support\Facades\Validator::make($data, [
                    'name of company' => ['required', 'string', 'max:255'],
                ]);

                if ($validator->fails()) {
                    logger()->warning("$errorNum. Skipping row due to validation: " . json_encode($data) . "\n");
                    $errorNum++;
                    continue;
                }

                $sanitized = [
                    'request_date' => trim($data['date of request'] ?? ''),
                    'company_name' => trim($data['name of company']),
                    'city' => trim($data['city'] ?? ''),
                    'address' => trim($data['address'] ?? ''),
                    'contact_details' => trim($data['contact details'] ?? ''),
                    'sector' => trim($data['sector'] ?? ''),
                    'vacancies' => trim($data['vacancies'] ?? ''),
                    'related_qualifications' => trim($data['related qualifications'] ?? ''),
                    'job_titles' => trim($data['job titles (from tr)'] ?? ''),
                    'tr_qualifications' => trim($data['tr qualifications']),
                    'no_of_vacancies' => trim($data['no. of vacancies'] ?? ''),
                    'deployment_location' => trim($data['deployment location'] ?? ''),
                    'no_of_referred' => trim($data['no. of referred'] ?? ''),
                    'no_of_hired' => trim($data['no. of hired'] ?? ''),
                    'remarks' => trim($data['remarks'] ?? ''),
                    'attachment_link' => trim($data['attachment link'] ?? ''),
                ];

                $sanitized['request_date'] = $sanitized['request_date'] == '' ? null : $sanitized['request_date'];
                $sanitized['no_of_vacancies'] = $sanitized['no_of_vacancies'] == '' ? null : $sanitized['no_of_vacancies'];
                $sanitized['no_of_referred'] = $sanitized['no_of_referred'] == '' ? null : $sanitized['no_of_referred'];
                $sanitized['no_of_hired'] = $sanitized['no_of_hired'] == '' ? null : $sanitized['no_of_hired'];

                JobVacancy::create([
                    'request_date' => $sanitized['request_date'],
                    'company_name' => $sanitized['company_name'],
                    'city' => $sanitized['city'],
                    'address' => $sanitized['address'],
                    'contact_details' => $sanitized['contact_details'],
                    'sector' => $sanitized['sector'],
                    'vacancies' => $sanitized['vacancies'],
                    'related_qualifications' => $sanitized['related_qualifications'],
                    'job_titles' => $sanitized['job_titles'],
                    'tr_qualifications' => $sanitized['tr_qualifications'],
                    'no_of_vacancies' => $sanitized['no_of_vacancies'],
                    'deployment_location' => $sanitized['deployment_location'],
                    'no_of_referred' => $sanitized['no_of_referred'],
                    'no_of_hired' => $sanitized['no_of_hired'],
                    'remarks' => $sanitized['remarks'],
                    'attachment_link' => $sanitized['attachment_link'],
                ]);
            }
        }

        logger()->info('Google Sheets data import completed');
        return redirect()->route('admin.view-vacancies')->with('success', 'Google Sheets data import complete.');
    }

    // Format: 08/05/1930
    public function dateFormat1($date) 
    {
        $formattedDate = $date;

        if (strlen($date) == 10 && str_contains($date, '/')) {
            $date = Carbon::createFromFormat('m/d/Y', $date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }

    // Format: 05-Aug-1930
    public function dateFormat2($date) 
    {
        $formattedDate = $date;

        if (strlen($date) == 11 && str_contains($date, '-')) {
            $date = Carbon::parse($date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }

    // Format: 08-05-1930
    public function dateFormat3($date) 
    {
        $formattedDate = $date;

        if (strlen($date) == 10 && str_contains($date, '-')) {
            $date = Carbon::createFromFormat('m-d-Y', $date);
            $formattedDate = $date->format('Y-m-d');
        }

        return $formattedDate;
    }
}
