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

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin,superadmin'])->controller(HomeController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.home');
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'role:admin,superadmin'])->controller(TableOfGraduatesController::class)->group(function () {
    Route::get('/admin/list-of-graduates', 'index')->name('admin.table-of-graduates');
    Route::get('/admin/list-of-graduates/search', 'search_graduates')->name('admin.search-graduates');
    Route::get('/admin/list-of-graduates/create-record', 'create_view')->name('admin.create-record.view');
    Route::get('/admin/list-of-graduates/record-details/{graduate}', 'read')->name('admin.record-details');
    Route::get('/admin/list-of-graduates/update-record/{graduate}', 'update_view')->name('admin.update-record.view');
    Route::post('/admin/list-of-graduates/create-record', 'create')->name('admin.create-record');
    Route::put('/admin/list-of-graduates/update-record/{graduate}', 'update')->name('admin.update-record');
    Route::delete('/admin/list-of-graduates/record-details/{graduate}', 'delete')->name('admin.delete-record');
    Route::delete('/admin/list-of-graduates', 'truncate')->name('admin.truncate-graduates');
});

Route::controller(TableOfGraduatesController::class)->group(function () {
    Route::get('/list-of-graduates', 'index')->name('table-of-graduates');
    Route::get('/list-of-graduates/search', 'search_graduates')->name('search-graduates');
});

Route::middleware(['auth', 'role:admin,superadmin'])->controller(JobVacanciesController::class)->group(function () {
    Route::get('/admin/job-vacancies', 'index')->name('admin.job-vacancies');
    Route::get('/admin/job-vacancies/{vacancy}/json', 'apiShow')->name('admin.vacancies.api');
    Route::get('/admin/job-vacancies/search', 'searchVacancies')->name('admin.search.vacancies');
});

Route::middleware(['auth', 'role:user'])->get('/job-vacancies/search', [JobVacanciesController::class, 'searchVacancies'])->name('search.vacancies');

Route::controller(JobVacanciesController::class)->group(function () {
    Route::get('/job-vacancies', 'index')->name('job-vacancies');
    Route::get('/job-vacancies/{vacancy}/json', 'apiShow')->name('vacancies.api');
});

Route::middleware(['auth', 'role:superadmin'])->controller(ViaGoogleSheetsController::class)->group(function () {
    Route::get('/admin/via-google-sheets', 'index')->name('admin.via-google-sheets');
    Route::get('/admin/via-google-sheets/import-graduate-sheet', 'import_sheet')->name('admin.import-graduate');
    Route::get('/admin/via-google-sheets/export-graduate-data', 'export_data')->name('admin.export-graduate');
    Route::get('/admin/via-google-sheets/import-vacancies', 'importVacancies')->name('import.vacancies');
    Route::get('/admin/via-google-sheets/import-companies', 'importCompanies')->name('import.companies');
});