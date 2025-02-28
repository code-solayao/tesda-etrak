<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login.index');

Route::get('/register', [LoginController::class, 'register'])->name('login.register');