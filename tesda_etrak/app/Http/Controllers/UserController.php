<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function login_post(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'], 
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/e-trak');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.'
        ])->onlyInput('email');
    }

    public function signup() {
        return view('login.signup');
    }

    public function signup_post(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'], 
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')], 
            'password' => ['required', 'string', 'min:1', 'max:100']
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
        Auth::login($user);

        return redirect()->route('e-trak.index')->with('success', 'Account created successfully!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }
}
