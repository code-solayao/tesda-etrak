<?php

use App\Http\Controllers\EtrakController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->name('login.index');
Route::post('/login', [UserController::class, 'login_post'])->name('login.post');

Route::get('/login/signup', [UserController::class, 'signup'])->name('login.signup');
Route::post('/login/signup', [UserController::class, 'signup_post'])->name('login.signup.post');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/e-trak', [EtrakController::class, 'index'])->name('e-trak.index');