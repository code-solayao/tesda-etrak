<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtrakController extends Controller
{
    public function index() {
        return view('/e-trak/index');
    }

    public function view_records() {
        //$graduates = DB::select("CALL read_records()");

        //return view('e-trak.records', compact('graduates'));
        return view('/e-trak/view-records');
    }

    public function create_record_page() {
        return view('/e-trak/create-record');
    }

    public function create_record() {
        return view('/e-trak/view-records');
    }
}
