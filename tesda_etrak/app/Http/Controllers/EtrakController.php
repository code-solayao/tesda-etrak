<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EtrakController extends Controller
{
    public function index() {
        return view('e-trak.index');
    }
}
