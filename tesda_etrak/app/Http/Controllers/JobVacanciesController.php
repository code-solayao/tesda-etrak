<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\JobVacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JobVacanciesController extends Controller
{
    public function index(Request $request) {
        $companies = Company::with('job_vacancies')->get(); // Eager Loading (reduce number of queries)
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        return view('job-vacancies.index', compact('companies', 'search', 'search_category'));
    }

    public function vacancyApi(JobVacancy $vacancy) {
        return response()->json($vacancy);
    }

    public function searchVacancies(Request $request) 
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

    public function addVacancyView() {
        $test = 'Hello world!';
        return view('job-vacancies.add-vacancy', compact('test'));
    }

    public function viewCompanies(Request $request) {
        $companies = Company::orderBy('id', 'desc')->get();
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        return view('job-vacancies.view-companies', compact('companies', 'search', 'search_category'));
    }

    public function companyApi(Company $company) {
        return response()->json($company);
    }

    public function addCompanyView() {
        return view('job-vacancies.add-company');
    }

    public function addCompany(Request $request) 
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'city' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'contact_details' => ['nullable', 'string', 'max:255'],
            'sector' => ['nullable', 'string', 'max:255'],
            'logo_url' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        foreach ($validated as $key => $value) {
            $validated[$key] = strip_tags($value);
        }

        $name = isset($validated['name']) == true ? $validated['name'] : '';
        $city = isset($validated['city']) == true ? $validated['city'] : '';
        $address = isset($validated['address']) == true ? $validated['address'] : '';
        $contact_details = isset($validated['contact_details']) == true ? $validated['contact_details'] : '';
        $sector = isset($validated['sector']) == true ? $validated['sector'] : '';

        if ($request->hasFile('logo_url')) {
            $validated['logo_url'] = $request->file('logo_url')->store('logos', 'public');
        }

        $logo_url = isset($validated['logo_url']) == true ? $validated['logo_url'] : '';

        Company::create([
            'name' => $name,
            'city' => $city,
            'address' => $address,
            'contact_details' => $contact_details,
            'sector' => $sector,
            'logo_url' => $logo_url,
        ]);

        $success_message = 'Created successfully: ' . $name . ' - ' . $city;
        return redirect()->route('admin.view.companies')->with('success', $success_message);
    }

    // Handle the image upload
    public function store(Request $request)
    {
        // Validate the uploaded image
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Limit to image types and size
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');  // Store image in storage/app/public/images

            // Optionally, save $path to the database or do something else with it
            
            return back()->with('success', 'Image uploaded successfully!');
        }

        return back()->with('error', 'Failed to upload image.');

        // php artisan storage:link
        // Display: <img src="{{ asset('storage/' . $imagePath) }}" alt="Uploaded Image">
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
