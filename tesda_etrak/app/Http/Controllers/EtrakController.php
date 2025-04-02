<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtrakController extends Controller
{
    public function index() {
        return view('index');
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
            $graduates = DB::table('graduates')->orderBy('id', 'desc')->paginate(10);
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
            case "Last name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('last_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "First name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('first_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Middle name":
                $graduates = Graduate::where(function($query) use ($search) {
                    $query->where('middle_name', 'LIKE', "%$search%");
                })->orderBy('id', 'desc')->paginate(10);
                break;
            case "Extension name":
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
                $graduates = DB::table('graduates')->orderBy('id', 'desc')->paginate(10);
        }

        return view('view-records', compact('graduates', 'search', 'search_category'));
    }

    public function view_create(Request $request) {
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
            'scholarship_type' => ['nullable', 'string', 'max:50'], 
            'address' => ['nullable', 'string', 'max:255'], 
            'allocation' => ['nullable', 'string', 'max:50']
        ]);

        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $full_name = $this->full_name_format($validated['last_name'], $validated['first_name'], $validated['middle_name'], $validated['extension_name']);
        $sex = isset($validated['sex']) == true ? $validated['sex'] : '';

        // Add default values for extra fields in Excel. Either implement here or with the Factory-Seeder method

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
            'allocation' => $validated['allocation']
        ]);

        return redirect()->route('view-records')->with('success', 'Created record successfully!');
    }

    public function view_details(Graduate $graduate) {
        return view('record-details', compact('graduate'));
    }

    public function view_update(Graduate $graduate) {
        return view('update-record', compact('graduate'));
    }

    public function delete(Graduate $graduate) {
        $graduate->delete();
        return redirect()->route('view-records')->with('success', 'Deleted record successfully!');
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
