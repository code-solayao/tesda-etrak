<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobVacanciesController;
use App\Http\Controllers\TableOfGraduatesController;
use App\Http\Controllers\ViaGoogleSheetsController;
use Illuminate\Support\Facades\Route;

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/google-error-502', function () {
    return view('via-google-sheets.google-error-502');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'view_login')->name('view.login');
    Route::get('/signup', 'view_signup')->name('view.signup');
    Route::post('/login', 'login')->name('login');
    Route::post('/signup', 'signup')->name('signup');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->controller(HomeController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.home');
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->controller(JobVacanciesController::class)->group(function () {
    Route::get('/admin/job-vacancies', 'index')->name('admin.job-vacancies');
    Route::get('/admin/job-vacancies/get', 'search_vacancies')->name('admin.search-vacancies');
    Route::get('/admin/job-vacancies/import-data', 'import_data')->name('import.vacancies.data');
});

Route::get('/job-vacancies', [JobVacanciesController::class, 'index'])->name('job-vacancies');

Route::get('/job-vacancies/search', [JobVacanciesController::class, 'search_vacancies'])->name('search-vacancies')->middleware('auth', 'role:user');

Route::middleware(['auth', 'role:admin'])->controller(TableOfGraduatesController::class)->group(function () {
    Route::get('/admin/table-of-graduates', 'index')->name('admin.table-of-graduates');
    Route::get('/admin/table-of-graduates/search', 'search_graduates')->name('admin.search-graduates');
    Route::get('/admin/table-of-graduates/create-record', 'create_view')->name('admin.create-record.view');
    Route::get('/admin/table-of-graduates/record-details/{graduate}', 'read')->name('admin.record-details');
    Route::get('/admin/table-of-graduates/update-record/{graduate}', 'update_view')->name('admin.update-record.view');
    Route::post('/admin/table-of-graduates/create-record', 'create')->name('admin.create-record');
    Route::put('/admin/table-of-graduates/update-record/{graduate}', 'update')->name('admin.update-record');
    Route::delete('/admin/table-of-graduates/record-details/{graduate}', 'delete')->name('admin.delete-record');
    Route::delete('/admin/table-of-graduates', 'truncate')->name('admin.truncate-graduates');
});

Route::get('/table-of-graduates', [TableOfGraduatesController::class, 'index'])->name('table-of-graduates');

Route::middleware(['auth', 'role:user'])->controller(TableOfGraduatesController::class)->group(function () {
    Route::get('/table-of-graduates/search', 'search_graduates')->name('search-graduates');
    Route::get('/table-of-graduates/record-details/{graduate}', 'read')->name('record-details');
});

Route::middleware(['auth', 'role:admin'])->controller(ViaGoogleSheetsController::class)->group(function () {
    Route::get('/admin/via-google-sheets', 'index')->name('admin.via-google-sheets');
    Route::get('/admin/via-google-sheets/import-graduate-sheet', 'import_sheet')->name('admin.import-graduate');
    Route::get('/admin/via-google-sheets/export-graduate-data', 'export_data')->name('admin.export-graduate');
    Route::get('/admin/via-google-sheets/logs', 'display_logs')->name('admin.display.log');
    Route::post('/admin/google-sheets-data/logs/clear', 'clear_logs')->name('admin.clear.logs');
});