<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtrakController;
use Illuminate\Support\Facades\Route;

Route::get('/laravel', function () {
    return view('welcome');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'view_login')->name('view.login');
    Route::get('/signup', 'view_signup')->name('view.signup');
    Route::post('/login', 'login')->name('login');
    Route::post('/signup', 'signup')->name('signup');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->controller(EtrakController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/view-records', 'view_records')->name('view-records');
    Route::get('/view-records/get', 'search_graduates')->name('search-graduates');
    Route::get('/create-record', 'view_create')->name('view.create');
    Route::get('/record-details/{graduate}', 'view_details')->name('view.details');
    Route::get('/update-record/{graduate}', 'view_update')->name('view.update');
    Route::post('/create-record', 'create')->name('create');
    Route::delete('/record-details/{graduate}', 'delete')->name('delete');
});