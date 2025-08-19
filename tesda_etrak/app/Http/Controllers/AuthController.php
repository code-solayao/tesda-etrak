<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function view_login() {
        return view('auth.login');
    }

    public function view_signup() {
        return view('auth.signup');
    }

    public function view_signup_admin() {
        return view('auth.signup-admin');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email', 
            'password' => 'required|string'
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Invalid credentials'
        ]);
    }

    public function signup(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100', 
            'email' => 'required|email|unique:users', 
            'password' => 'required|string|min:2|max:100|confirmed'
        ]);

        $user = User::create($validated);
        Auth::login($user);

        return redirect()->route('index')->with('success', 'Account created successfully!');
    }

    public function signup_admin(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100', 
            'email' => 'required|email|unique:users', 
            'password' => 'required|string|min:2|max:100|confirmed'
        ]);

        $validated['role'] = 'admin';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => Carbon::now(),
            'role' => 'admin',
            'password' => $validated['password'],
            'remember_token' => null,
        ]);
        Auth::login($user);

        return redirect()->route('index')->with('success', 'Account created successfully!');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('view.login');
    }
}
