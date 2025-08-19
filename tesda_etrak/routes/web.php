<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtrakController;
use Illuminate\Support\Facades\Route;

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/google-error-502', function () {
    return view('google-error-502');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'view_login')->name('view.login');
    Route::get('/signup', 'view_signup')->name('view.signup');
    Route::get('/signup-admin', 'view_signup_admin')->name('view.signup-admin');
    Route::post('/login', 'login')->name('login');
    Route::post('/signup', 'signup')->name('signup');
    Route::post('/signup-admin', 'signup_admin')->name('signup.admin');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::controller(EtrakController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/view-records', 'view_records')->name('view-records');
    Route::get('/view-records/get', 'search_graduates')->name('search-graduates');
    Route::get('/record-details/{graduate}', 'view_details')->name('view.details');
    Route::get('/google-sheets-data', 'view_sheets_data')->name('view.sheets-data');
    Route::get('/google-sheets-data/logs', 'display_logs')->name('display.log');
});

Route::middleware('auth', 'role:admin')->controller(EtrakController::class)->group(function () {
    Route::get('/create-record', 'view_create')->name('view.create');
    Route::get('/update-record/{graduate}', 'view_update')->name('view.update');
    Route::post('/create-record', 'create')->name('create');
    Route::put('/update-record/{graduate}', 'update')->name('update');
    Route::delete('/record-details/{graduate}', 'delete')->name('delete');
    Route::delete('/view-records', 'delete_all')->name('delete-all');
    Route::get('/google-sheets-data/import-data', 'import_data')->name('import.data');
    Route::get('/google-sheets-data/export-data', 'export_data')->name('export.data');
    Route::post('/google-sheets-data/logs/clear', 'clear_logs')->name('clear.logs');
});