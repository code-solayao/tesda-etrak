<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtrakController extends Controller
{
    public function index() {
        return view('/e-trak/index');
    }

    public function view_records() {
        $graduates = Graduate::select('id', 'last_name', 'first_name', 'middle_name', 'extension_name', 'employment_status', 'allocation', 'qualification_title')->get();
        //$graduates = DB::select("CALL read_records()");

        return view('/e-trak/view-records', compact('graduates'));
    }

    public function create_record_page() {
        return view('/e-trak/create-record');
    }

    public function create_record(Request $request) {
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
            'scholarship_type' => ['nullable', 'string', 'max:50'], 
            'address' => ['nullable', 'string', 'max:255'], 
            'allocation' => ['nullable', 'string', 'max:50']
        ]);

        $last_name = strip_tags($validated['last_name']);
        $first_name = strip_tags($validated['first_name']);
        $middle_name = strip_tags($validated['middle_name']);
        $extension_name = strip_tags($validated['extension_name']);
        $full_name = $this->full_name_format($last_name, $first_name, $middle_name, $extension_name);

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
            'sex' => isset($validated['sex']) == true ? $validated['sex'] : '', 
            'birthdate' => $validated['birthdate'], 
            'contact_number' => $validated['contact_number'], 
            'email' => $validated['email'], 
            'scholarship_type' => $validated['scholarship_type'], 
            'address' => $validated['address'], 
            'allocation' => $validated['allocation']
        ]);

        return redirect()->route('view-records')->with('success', 'Created record successfully!');
    }

    public function record_details(Graduate $graduate) {
        //$graduate = Graduate::findOrFail($id);
        return view('/e-trak/record-details', compact('graduate'));
    }

    public function update_record_page(Graduate $graduate) {
        return view('/e-trak/update-record', compact('graduate'));
    }

    public function update_record(Graduate $graduate, Request $request) {
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
            'scholarship_type' => ['nullable', 'string', 'max:50'], 
            'address' => ['nullable', 'string', 'max:255'], 
            'allocation' => ['nullable', 'string', 'max:50'], 
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
            'employment_status' => ['nullable', 'string', 'max:255'], 
            'hired_date' => ['nullable', 'string', 'max:50'], 
            'submitted_documents_date' => ['nullable', 'string', 'max:50'], 
            'interview_date' => ['nullable', 'string', 'max:50'], 
            'not_hired_reason' => ['nullable', 'string', 'max:50']
        ]);

        $graduate->update([
            'district' => $validated['district'], 
            'city' => $validated['city'], 
            'tvi' => $validated['tvi'], 
            'qualification_title' => $validated['qualification_title'], 
            'sector' => $validated['sector'], 
            'last_name' => $validated['last_name'], 
            'first_name' => $validated['first_name'], 
            'middle_name' => $validated['middle_name'], 
            'extension_name' => $validated['extension_name'], 
            'full_name' => $validated['full_name'], 
            'sex' => isset($validated['sex']) == true ? $validated['sex'] : '', 
            'birthdate' => $validated['birthdate'], 
            'contact_number' => $validated['contact_number'], 
            'email' => $validated['email'], 
            'scholarship_type' => $validated['scholarship_type'], 
            'address' => $validated['address'], 
            'allocation' => $validated['allocation'], 
            'verification_means' => ['nullable', 'string', 'max:50'], 
            'verification_date' => ['nullable', 'string', 'max:50'], 
            'verification_status' => isset($validated['verification_status']) == true ? $validated['verification_status'] : '', 
            'follow_up_date_1' => ['nullable', 'string', 'max:50'], 
            'follow_up_date_2' => ['nullable', 'string', 'max:50'], 
            'response_status' => isset($validated['response_status']) == true ? $validated['response_status'] : '', 
            'not_interested_reason' => ['nullable', 'string', 'max:255'], 
            'referral_status' => isset($validated['referral_status']) == true ? $validated['referral_status'] : '', 
            'referral_date' => ['nullable', 'string', 'max:50'], 
            'no_referral_reason' => ['nullable', 'string', 'max:255'], 
            'invalid_contact' => isset($validated['invalid_contact']) == true ? $validated['invalid_contact'] : '', 
            'company_name' => ['nullable', 'string', 'max:255'], 
            'company_address' => ['nullable', 'string', 'max:255'], 
            'job_title' => ['nullable', 'string', 'max:255'], 
            'employment_status' => isset($validated['employment_status']) == true ? $validated['employment_status'] : '', 
            'hired_date' => ['nullable', 'string', 'max:50'], 
            'submitted_documents_date' => ['nullable', 'string', 'max:50'], 
            'interview_date' => ['nullable', 'string', 'max:50'], 
            'not_hired_reason' => ['nullable', 'string', 'max:50']
        ]);

        return redirect()->route('record_details', $graduate->id)->with('success', 'Updated record successfully!');
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
