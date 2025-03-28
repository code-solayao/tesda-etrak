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
        
    }
}
