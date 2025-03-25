<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'login_view'])->name('login.index');
Route::post('/login/post', [UserController::class, 'login'])->name('login');

Route::get('/signup', [UserController::class, 'signup_view'])->name('signup.index');
Route::post('/signup/post', [UserController::class, 'signup'])->name('signup');
