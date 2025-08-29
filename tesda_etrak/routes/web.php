<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtrakController;
use App\Http\Controllers\JobVacanciesController;
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
    Route::post('/login', 'login')->name('login');
    Route::post('/signup', 'signup')->name('signup');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:user'])->controller(EtrakController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/view-records', 'view_records')->name('view-records');
    Route::get('/view-records/get', 'search_graduates')->name('search-graduates');
    Route::get('/record-details/{graduate}', 'view_details')->name('view.details');
});

Route::controller(EtrakController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/view-records', 'view_records')->name('view-records');
    Route::get('/view-records/get', 'search_graduates')->name('search-graduates');
    Route::get('/record-details/{graduate}', 'view_details')->name('view.details');
});

Route::middleware(['auth', 'role:admin,super-admin'])->controller(EtrakController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.index');
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('/admin/view-records', 'view_records')->name('admin.view-records');
    Route::get('/admin/view-records/get', 'search_graduates')->name('admin.search-graduates');
    Route::get('/admin/create-record', 'view_create')->name('admin.view-create');
    Route::get('/admin/record-details/{graduate}', 'view_details')->name('admin.view-details');
    Route::get('/admin/update-record/{graduate}', 'view_update')->name('admin.view-update');
    Route::post('/admin/create-record', 'create')->name('create');
    Route::put('/admin/update-record/{graduate}', 'update')->name('update');
    Route::delete('/admin/record-details/{graduate}', 'delete')->name('delete');
    Route::delete('/admin/view-records', 'delete_all')->name('delete-all');
    Route::get('/admin/google-sheets-data', 'view_sheets_data')->name('admin.view-sheets-data');
    Route::get('/admin/google-sheets-data/import-data', 'import_data')->name('import.data');
    Route::get('/admin/google-sheets-data/export-data', 'export_data')->name('export.data');
    Route::get('/admin/google-sheets-data/logs', 'display_logs')->name('display.log');
    Route::post('/admin/google-sheets-data/logs/clear', 'clear_logs')->name('clear.logs');
});

Route::middleware(['auth', 'role:admin'])->controller(JobVacanciesController::class)->group(function () {
    Route::get('/admin/job-vacancies', 'index')->name('admin.view-vacancies');
    Route::get('/admin/job-vacancies/get', 'search_vacancies')->name('admin.search-vacancies');
    Route::get('/admin/job-vacancies/import-data', 'import_data')->name('import.vacancies.data');
});