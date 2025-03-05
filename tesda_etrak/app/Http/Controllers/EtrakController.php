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
            'district' => ['string', 'max:50'], 
            'city' => ['string', 'max:50'], 
            'tvi' => ['string', 'max:255'], 
            'qualification_title' => ['string', 'max:255'], 
            'sector' => ['string', 'max:255'], 
            'last_name' => ['required', 'string', 'max:255'], 
            'first_name' => ['required', 'string', 'max:255'], 
            'middle_name' => ['string', 'max:255'], 
            'extension_name' => ['string', 'max:50'], 
            'sex' => ['string', 'max:50'], 
            'birthdate' => ['string', 'max:50'], 
            'contact_number' => ['string', 'max:20'], 
            'email' => ['string', 'max:255'], 
            'scholarship_type' => ['string', 'max:50'], 
            'address' => ['string', 'max:255'], 
            'allocation' => ['string', 'max:50']
        ]);

        $full_name = $this->full_name_format($validated['last_name'], $validated['first_name'], $validated['middle_name'], $validated['extension_name']);

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
            'sex' => $validated['sex'], 
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
        return view('/e-trak/update_record', compact($graduate));
    }

    public function update_record(Request $request) {
        
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
