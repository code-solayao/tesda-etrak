<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

class EtrakController extends Controller
{
    public function index() {
        return view('index');
    }

    public function dashboard() {
        return view('dashboard');
    }

    public function view_records(Request $request) {
        $graduates = Graduate::select('id', 'last_name', 'first_name', 'middle_name', 'extension_name', 'employment_status', 'allocation', 'qualification_title')
        ->orderBy('id', 'desc')->paginate(10);
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        return view('view-records', compact('graduates', 'search', 'search_category'));
    }

    public function search_graduates(Request $request) {
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

    public function create(Request $request) {
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
            'allocation' => ['nullable', 'string', 'max:50']
        ]);

        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $full_name = $this->full_name_format($validated['last_name'], $validated['first_name'], $validated['middle_name'], $validated['extension_name']);
        $sex = isset($validated['sex']) == true ? $validated['sex'] : '';

        // Add default values for extra fields in Excel. Either implement here or with the Factory-Seeder method
        $count = 1;
        $no_of_graduates = 1;
        $job_vacancies = 'No';

        Graduate::create([
            'district' => $validated['district'], 
            'city' => $validated['city'], 
            'tvi' => $validated['tvi'], 
            'qualification_title' => $validated['qualification_title'], 
            'sector' => $validated['sector'], 
            'last_name' => $validated['last_name'], 
            'first_name' => $validated['first_name'], 
            'middle_name' => $validated['middle_name'], 
            'extension_name' => $validated['extension_name'], 
            'full_name' => $full_name, 
            'sex' => $sex, 
            'birthdate' => $validated['birthdate'], 
            'contact_number' => $validated['contact_number'], 
            'email' => $validated['email'], 
            'scholarship_type' => $validated['scholarship_type'], 
            'address' => $validated['address'], 
            'allocation' => $validated['allocation'], 
            'count' => $count, 
            'no_of_graduates' => $no_of_graduates, 
            'job_vacancies' => $job_vacancies
        ]);

        return redirect()->route('view-records')->with('success', 'Created record successfully!');
    }

    public function view_details(Graduate $graduate) {
        return view('record-details', compact('graduate'));
    }

    public function view_update(Graduate $graduate) {
        return view('update-record', compact('graduate'));
    }

    public function update(Graduate $graduate, Request $request) {
        $validated = $request->validate([
            'verification_means' => ['nullable', 'string', 'max:50'], 
            'verification_date' => ['nullable', 'string', 'max:50'], 
            'verification_status' => ['nullable', 'string', 'max:50'], 
            'follow_up_date_1' => ['nullable', 'string', 'max:50'], 
            'follow_up_date_2' => ['nullable', 'string', 'max:50'], 
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
            'not_hired_reason' => ['nullable', 'string', 'max:50']
        ]);
        
        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $verification_status = isset($validated['verification_status']) == true ? $validated['verification_status'] : '';
        $response_status = isset($validated['response_status']) == true ? $validated['response_status'] : '';
        $not_interested_reason = isset($validated['not_interested_reason']) == true ? $validated['not_interested_reason'] : '';
        $referral_status = isset($validated['referral_status']) == true ? $validated['referral_status'] : '';
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
            'not_hired_reason' => $not_hired_reason
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

    private function full_name_format($last_name, $first_name, $middle_name, $extension_name) {
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
}
