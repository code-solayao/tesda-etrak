<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use App\Services\GoogleSheetsService;
use Carbon\Carbon;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EtrakController extends Controller
{
    public function index() {
        return view('index');
    }

    public function dashboard() {
        return view('dashboard');
    }

    public function view_records(Request $request) 
    {
        $graduates = Graduate::select('id', 'last_name', 'first_name', 'middle_name', 'extension_name', 'employment_status', 'allocation', 'qualification_title')
        ->orderBy('id', 'desc')->paginate(10);
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        return view('view-records', compact('graduates', 'search', 'search_category'));
    }

    public function search_graduates(Request $request) 
    {
        $graduates = null;
        $search = null;
        $search_category = null;

        if (empty($request)) {
            $graduates = Graduate::select()->orderBy('id', 'desc')->paginate(10);
            return view('view-records', compact('graduates', 'search', 'search_category'));
        }

        $search = $request->input('search');
        $search_category = $request->input('search_category');

        switch ($search_category) {
            case "Record number":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('id', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Full Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('full_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Last Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('last_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "First Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('first_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Middle Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('middle_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Extension Name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('extension_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Status of Employment":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('employment_status', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Year of Graduation":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('allocation', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Qualification Title":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('qualification_title', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            default:
                if ($search == '') {
                    $graduates = Graduate::select('id', 'last_name', 'first_name', 'middle_name', 'extension_name', 'employment_status', 'allocation', 'qualification_title')
                    ->orderBy('id', 'desc')->paginate(10);
                }
                else {
                    $graduates = Graduate::where(function($query) use ($search) {
                        $query->where('id', 'LIKE', "%$search%")
                        ->orWhere('full_name', 'LIKE', "%$search%")
                        ->orWhere('last_name', 'LIKE', "%$search%")
                        ->orWhere('first_name', 'LIKE', "%$search%")
                        ->orWhere('extension_name', 'LIKE', "%$search%")
                        ->orWhere('employment_status', 'LIKE', "%$search%")
                        ->orWhere('allocation', 'LIKE', "%$search%")
                        ->orWhere('qualification_title', 'LIKE', "%$search%");
                    })->orderBy('id', 'desc')->paginate(10);
                }
        }

        return view('view-records', compact('graduates', 'search', 'search_category'));
    }

    public function view_create() {
        return view('create-record');
    }

    public function create(Request $request) 
    {
        $validated = $request->validate([
            'district' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:50'],
            'tvi' => ['nullable', 'string', 'max:255'],
            'qualification_title' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'extension_name' => ['nullable', 'string', 'max:50'],
            'sex' => ['nullable', 'string', 'max:50'],
            'birthdate' => ['nullable', 'string', 'max:50'],
            'contact_number' => ['nullable', 'string', 'min:13', 'max:16'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'scholarship_type' => ['nullable', 'string', 'max:50'],
            'allocation' => ['nullable', 'string', 'max:50'],
        ]);

        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $district = isset($validated['district']) == true ? $validated['district'] : '';
        $city = isset($validated['city']) == true ? $validated['city'] : '';
        $tvi = isset($validated['tvi']) == true ? $validated['tvi'] : '';
        $qualification_title = isset($validated['qualification_title']) == true ? $validated['qualification_title'] : '';
        $sector = isset($validated['sector']) == true ? $validated['sector'] : '';
        $middle_name = isset($validated['middle_name']) == true ? $validated['middle_name'] : '';
        $extension_name = isset($validated['extension_name']) == true ? $validated['extension_name'] : '';
        $full_name = $this->full_name_format($validated['last_name'], $validated['first_name'], $validated['middle_name'], $validated['extension_name']);
        $sex = isset($validated['sex']) == true ? $validated['sex'] : '';
        $birthdate = isset($validated['birthdate']) == true ? $validated['birthdate'] : '';
        $contact_number = isset($validated['contact_number']) == true ? $validated['contact_number'] : '';
        $email = isset($validated['email']) == true ? $validated['email'] : '';
        $address = isset($validated['address']) == true ? $validated['address'] : '';
        $scholarship_type = isset($validated['scholarship_type']) == true ? $validated['scholarship_type'] : '';
        $allocation = isset($validated['allocation']) == true ? $validated['allocation'] : '';
        $training_status = 'Pass';
        $assessment_result = '';
        $employment_before_training = 'Unemployed';
        $occupation = '';
        $employer_name = '';
        $employer_address = '';
        $employment_type = '';
        $date_hired = '';
        $verification_means = 'For Verification';
        $verification_date = '';
        $verification_status = '';
        $follow_up_date_1 = '';
        $follow_up_date_2 = '';
        $follow_up_remarks = '';
        $response_status = '';
        $not_interested_reason = '';
        $referral_status = 'No';
        $referral_date = '';
        $no_referral_reason = '';
        $invalid_contact = '';
        $company_name = '';
        $company_address = '';
        $job_title = '';
        $application_status = '';
        $not_proceed_reason = '';
        $employment_status = '';
        $hired_date = '';
        $submitted_documents_date = '';
        $interview_date = '';
        $not_hired_reason = '';
        $remarks = "";
        $count = 1;
        $no_of_graduates = 1;
        $no_of_employed = "";
        $verification = "";
        $job_vacancies = "No";

        Graduate::create([
            'district' => $district,
            'city' => $city,
            'tvi' => $tvi,
            'qualification_title' => $qualification_title,
            'sector' => $sector,
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $middle_name,
            'extension_name' => $extension_name,
            'full_name' => $full_name,
            'sex' => $sex,
            'birthdate' => $birthdate,
            'contact_number' => $contact_number,
            'email' => $email,
            'address' => $address,
            'scholarship_type' => $scholarship_type,
            'training_status' => $training_status,
            'assessment_result' => $assessment_result,
            'employment_before_training' => $employment_before_training,
            'occupation' => $occupation,
            'employer_name' => $employer_name,
            'employer_address' => $employer_address,
            'employment_type' => $employment_type,
            'date_hired' => $date_hired,
            'allocation' => $allocation,
            'verification_means' => $verification_means,
            'verification_date' => $verification_date,
            'verification_status' => $verification_status,
            'follow_up_date_1' => $follow_up_date_1,
            'follow_up_date_2' => $follow_up_date_2,
            'follow_up_remarks' => $follow_up_remarks,
            'response_status' => $response_status,
            'not_interested_reason' => $not_interested_reason,
            'referral_status' => $referral_status,
            'referral_date' => $referral_date,
            'no_referral_reason' => $no_referral_reason,
            'invalid_contact' => $invalid_contact,
            'company_name' => $company_name,
            'company_address' => $company_address,
            'job_title' => $job_title,
            'application_status' => $application_status,
            'not_proceed_reason' => $not_proceed_reason,
            'employment_status' => $employment_status,
            'hired_date' => $hired_date,
            'submitted_documents_date' => $submitted_documents_date,
            'interview_date' => $interview_date,
            'not_hired_reason' => $not_hired_reason,
            'remarks' => $remarks,
            'count' => $count,
            'no_of_graduates' => $no_of_graduates,
            'no_of_employed' => $no_of_employed,
            'verification' => $verification,
            'job_vacancies' => $job_vacancies,
        ]);

        return redirect()->route('view-records')->with('success', 'Created record successfully!');
    }

    public function view_details(Graduate $graduate) {
        return view('record-details', compact('graduate'));
    }

    public function view_update(Graduate $graduate) {
        return view('update-record', compact('graduate'));
    }

    public function update(Graduate $graduate, Request $request) 
    {
        $validated = $request->validate([
            'verification_means' => ['nullable', 'string', 'max:50'],
            'verification_date' => ['nullable', 'string', 'max:50'],
            'verification_status' => ['nullable', 'string', 'max:50'],
            'follow_up_date_1' => ['nullable', 'string', 'max:50'],
            'follow_up_date_2' => ['nullable', 'string', 'max:50'],
            'follow_up_remarks' => ['nullable', 'string', 'max:255'],
            'response_status' => ['nullable', 'string', 'max:50'],
            'not_interested_reason' => ['nullable', 'string', 'max:255'],
            'referral_status' => ['nullable', 'string', 'max:10'],
            'referral_date' => ['nullable', 'string', 'max:50'],
            'no_referral_reason' => ['nullable', 'string', 'max:255'],
            'invalid_contact' => ['nullable', 'string', 'max:10'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_address' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'application_status' => ['nullable', 'string', 'max:255'],
            'withdrawn_reason' => ['nullable', 'string', 'max:255'],
            'employment_status' => ['nullable', 'string', 'max:255'],
            'hired_date' => ['nullable', 'string', 'max:50'],
            'submitted_documents_date' => ['nullable', 'string', 'max:50'],
            'interview_date' => ['nullable', 'string', 'max:50'],
            'not_hired_reason' => ['nullable', 'string', 'max:50'],
        ]);
        
        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $verification_status = isset($validated['verification_status']) == true ? $validated['verification_status'] : '';
        $follow_up_remarks = isset($validated['follow_up_remarks']) == true ? $validated['follow_up_remarks'] : '';
        $response_status = isset($validated['response_status']) == true ? $validated['response_status'] : '';
        $not_interested_reason = isset($validated['not_interested_reason']) == true ? $validated['not_interested_reason'] : '';
        $referral_status = isset($validated['referral_status']) == true ? $validated['referral_status'] : 'No';
        $referral_date = isset($validated['referral_date']) == true ? $validated['referral_date'] : '';
        $no_referral_reason = isset($validated['no_referral_reason']) == true ? $validated['no_referral_reason'] : '';
        $invalid_contact = isset($validated['invalid_contact']) == true ? $validated['invalid_contact'] : '';

        $company_name = isset($validated['company_name']) == true ? $validated['company_name'] : '';
        $company_address = isset($validated['company_address']) == true ? $validated['company_address'] : '';
        $job_title = isset($validated['job_title']) == true ? $validated['job_title'] : '';
        $application_status = isset($validated['application_status']) == true ? $validated['application_status'] : '';
        $withdrawn_reason = isset($validated['withdrawn_reason']) == true ? $validated['withdrawn_reason'] : ''; 
        $employment_status = isset($validated['employment_status']) == true ? $validated['employment_status'] : '';
        $hired_date = isset($validated['hired_date']) == true ? $validated['hired_date'] : '';
        $submitted_documents_date = isset($validated['submitted_documents_date']) == true ? $validated['submitted_documents_date'] : '';
        $interview_date = isset($validated['interview_date']) == true ? $validated['interview_date'] : '';
        $not_hired_reason = isset($validated['not_hired_reason']) == true ? $validated['not_hired_reason'] : '';

        $graduate->update([
            'verification_means' => $validated['verification_means'],
            'verification_date' => $validated['verification_date'],
            'verification_status' => $verification_status,
            'follow_up_date_1' => $validated['follow_up_date_1'],
            'follow_up_date_2' => $validated['follow_up_date_2'],
            'follow_up_remarks' => $follow_up_remarks,
            'response_status' => $response_status,
            'not_interested_reason' => $not_interested_reason,
            'referral_status' => $referral_status,
            'referral_date' => $referral_date,
            'no_referral_reason' => $no_referral_reason,
            'invalid_contact' => $invalid_contact,
            'company_name' => $company_name,
            'company_address' => $company_address,
            'job_title' => $job_title,
            'application_status' => $application_status,
            'withdrawn_reason' => $withdrawn_reason,
            'employment_status' => $employment_status,
            'hired_date' => $hired_date,
            'submitted_documents_date' => $submitted_documents_date,
            'interview_date' => $interview_date,
            'not_hired_reason' => $not_hired_reason,
        ]);

        return redirect()->route('view.details', $graduate->id)->with('success', 'Updated record successfully!');
    }

    public function delete(Graduate $graduate) {
        $graduate->delete();
        return redirect()->route('view-records')->with('success', 'Deleted record successfully!');
    }

    public function delete_all() {
        Graduate::truncate();
        return redirect()->route('view-records')->with('success', 'Cleared all records successfully!');
    }

    public function view_sheets_data() {
        return view('google-sheets-data');
    }

    public function import_data() 
    {
        logger()->info('Initialising Google Sheets data import.');

        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $service = new Sheets($client);

        // $spreadsheetId = env('EMPLOYMENT_MONITORING_SYSTEM_ID');
        $spreadsheetId = '100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q';
        $range = 'List of Graduates';

        if (empty($spreadsheetId)) {
            logger()->error('Google Sheets data import failed: Spreadsheet ID is missing.');
            return 'Spreadsheet ID is not configured.';
        }

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
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
        $chunks = array_chunk($rows, 1000);

        $errorNum = 1;
        foreach ($chunks as $chunk) {
            logger()->info('Processing chunk...');

            foreach ($chunk as $row) {
                $normalizedRow = array_pad($row, count($headers), null);
                $normalizedRow = array_slice($normalizedRow, 0, count($headers));
                $data = array_combine($headers, $normalizedRow);

                $validator = Validator::make($data, [
                    'ln' => ['required', 'string', 'max:255'],
                    'fn' => ['required', 'string', 'max:255'],
                    'name' => ['required', 'string', 'max:255'],
                    'email address' => ['nullable', 'string', 'max:255'],
                ]);

                if ($validator->fails()) {
                    logger()->warning("$errorNum. Skipping row due to validation: " . json_encode($data) . "\n");
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
                    'employer_address' => trim($data['address of employer'] ?? ''),
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
                    'remarks' => trim($data['remarks'] ?? ''),
                    'count' => trim($data['count'] ?? ''),
                    'no_of_graduates' => trim($data['no. of graduates'] ?? ''),
                    'no_of_employed' => trim($data['no. of employed'] ?? ''),
                    'verification' => trim($data['verification'] ?? ''),
                    'job_vacancies' => trim($data['job vacancies (verification)'] ?? ''),
                    'follow_up_remarks' => trim($data['follow-up remarks'] ?? ''),
                    'application_status' => trim($data['application status (proceed or not for job opening)'] ?? ''),
                ];

                $sanitized['birthdate'] = $this->dateFormat1($sanitized['birthdate']);
                $sanitized['verification_date'] = $this->dateFormat1($sanitized['verification_date']);
                $sanitized['follow_up_date_1'] = $this->dateFormat1($sanitized['follow_up_date_1']);
                $sanitized['hired_date'] = $this->dateFormat2($sanitized['hired_date']);

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
                    'employer_address' => $sanitized['employer_address'],
                    'employment_type' => $sanitized['employment_type'],
                    'date_hired' => $sanitized['date_hired'],
                    'allocation' => $sanitized['allocation'],
                    'verification_means' => $sanitized['verification_means'],
                    'verification_date' => $sanitized['verification_date'],
                    'verification_status' => $sanitized['verification_status'],
                    'follow_up_date_1' => $sanitized['follow_up_date_1'],
                    'follow_up_date_2' => null,
                    'follow_up_remarks' => $sanitized['follow_up_remarks'],
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
                    'no_proceed_reason' => null,
                    'employment_status' => $sanitized['employment_status'],
                    'hired_date' => $sanitized['hired_date'],
                    'submitted_documents_date' => null,
                    'interview_date' => null,
                    'not_hired_reason' => null,
                    'remarks' => $sanitized['remarks'],
                    'count' => $sanitized['count'],
                    'no_of_graduates' => $sanitized['no_of_graduates'],
                    'no_of_employed' => $sanitized['no_of_employed'],
                    'verification' => $sanitized['verification'],
                    'job_vacancies' => $sanitized['job_vacancies'],
                ]);
            }
        }

        logger()->info('Google Sheets data import completed');
        return redirect()->route('view-records')->with('success', 'Google Sheets data import complete.');
    }
    
    public function export_data(GoogleSheetsService $service) 
    {
        logger()->info('Initialising local data export.');

        $client = new Client();
        $client->setAuthConfig(storage_path('app/credentials.json'));
        $client->addScope(Sheets::SPREADSHEETS);
        $service = new Sheets($client);

        $spreadsheetId = '1-PlAbP1Y0dgqUEmblx3atGrjkkPWkOxrTE1qglkwfvM';
        $range = 'List of Graduates';

        // Optional: clear old data
        $service->spreadsheets_values->clear(
            $spreadsheetId,
            $range,
            new Sheets\ClearValuesRequest()
        );

        $allRows = [];

        Graduate::chunk(500, function ($rows) use (&$allRows) {
            foreach ($rows as $row) {
                $allRows[] = [
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
                    $row->employer_address,
                    $row->employment_type,
                    $row->date_hired,
                    $row->allocation,
                    $row->verification_means,
                    $row->verification_date,
                    $row->verification_status,
                    $row->follow_up_date_1,
                    $row->follow_up_date_2,
                    $row->follow_up_remarks,
                    $row->response_status,
                    $row->not_interested_reason,
                    $row->referral_status,
                    $row->referral_date,
                    $row->no_referral_reason,
                    $row->invalid_contact,
                    $row->company_name,
                    $row->company_address,
                    $row->job_title,
                    $row->application_status,
                    $row->not_proceed_reason,
                    $row->employment_status,
                    $row->hired_date,
                    $row->submitted_documents_date,
                    $row->interview_date,
                    $row->not_hired_reason,
                    $row->remarks,
                    $row->count,
                    $row->no_of_graduates,
                    $row->no_of_employed,
                    $row->verification,
                    $row->job_vacancies,
                ];
            }
            
            logger()->info(count($allRows) . ' rows appended.');
        });

        // Optional: add headers
        $headers = [[
            'District',
            'City',
            'Name of TVI',
            'Qualification Title',
            'Sector',
            'LN',
            'FN',
            'MI',
            'Ext',
            'Name',
            'Sex',
            'Date of Birth',
            'Contact Number',
            'Email Address',
            'Address',
            'Scholarship Type',
            'Training Status',
            'Assessment Result',
            'Employment Before Training',
            'Occupation',
            'Name of Employer',
            'Employment Type',
            'Address of Employer',
            'Date Hired',
            'Allocation',
            'Means of Verification',
            'Date of Verification',
            'Status of Verification',
            'First Follow-up Date',
            'Second Follow-up Date',
            'Follow-up Remarks',
            'Status of Responses',
            'Reasons (Not Interested)',
            'Referral Status',
            'Referral Date',
            'Reasons (No Referral)',
            'Invalid Contact',
            'Name of Company',
            'Address (City)',
            'Job Title',
            'Application Status (Proceed or Not for Job Opening)',
            'Reasons (Did Not Proceed for Job Opening)',
            'Employment Status',
            'Date of Hired',
            'Date of Submitted Documents',
            'Date of Interview',
            'Reasons (Not Hired)',
            'Remarks',
            'Count',
            'No. of Graduates',
            'No. of Employed',
            'Verification',
            'Job Vacancies (Verification)',
        ]];
        $values = array_merge($headers, $allRows);

        // Update rows
        $body = new Sheets\ValueRange([
            'values' => $values
        ]);
        $params = ['valueInputOption' => 'RAW'];
        $service->spreadsheets_values->update($spreadsheetId, $range, $body, $params);
        
        logger()->info('Local data export complete.');
        return redirect()->route('view.sheets-data')->with('Local data export complete.');
    }

    public function display_logs() 
    {
        $logPath = storage_path('logs/laravel.log');

        if (!File::exists($logPath)) {
            return response()->json(['log' => 'Log file not found.']);
        }

        $logs = File::get($logPath);

        return response()->json(['log' => nl2br(e($logs))]);
    }

    public function clear_logs() 
    {
        $logPath = storage_path('logs/laravel.log');

        if (!File::exists($logPath)) {
            File::put($logPath, '');
            return response()->json(['status' => 'cleared']);
        }

        return response()->json(['status' => 'not_found'], 404);
    }

    private function full_name_format($last_name, $first_name, $middle_name, $extension_name) 
    {
        $format = "";

        if (empty($middle_name) && empty($extension_name)) {
            $format = $last_name . ", " . $first_name;
        } 
        else if (empty($extension_name)) {
            $format = "$last_name, $first_name $middle_name";
        } 
        else if (empty($middle_name)) {
            $format = "$last_name $extension_name, $first_name";
        } 
        else {
            $format = "$last_name $extension_name, $first_name $middle_name";
        }

        return $format;
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
