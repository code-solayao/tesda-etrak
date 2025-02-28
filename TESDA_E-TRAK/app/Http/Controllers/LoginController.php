<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function login(Request $request) {
        
    }

    public function register(Request $request = null) {
        if ($request == null) {
            return view('login.register');
        }
        else {
            return redirect('/'); // tuloy dito
        }
    }
}
