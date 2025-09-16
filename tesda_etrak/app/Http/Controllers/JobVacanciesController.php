<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobVacanciesController extends Controller
{
    public function index(Request $request) {
        $vacancies = JobVacancy::orderBy('id', 'desc')->get();
        $search = $request->input('search');
        $search_category = $request->input('search_category');

        return view('job-vacancies.index', compact('vacancies', 'search', 'search_category'));
    }

    public function apiShow(JobVacancy $vacancy) {
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
