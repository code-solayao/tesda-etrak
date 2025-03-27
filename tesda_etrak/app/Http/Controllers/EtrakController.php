<?php

namespace App\Http\Controllers;

use App\Models\Graduate;
use Illuminate\Http\Request;

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
}
