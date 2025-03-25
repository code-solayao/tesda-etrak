<?php

use App\Http\Controllers\EtrakController;
use App\Http\Controllers\ImportExcelFileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'index'])->name('login-page');
Route::post('/login/post', [UserController::class, 'login'])->name('login');

Route::get('/login/signup', [UserController::class, 'signup_page'])->name('signup-page');
Route::post('/login/signup/post', [UserController::class, 'signup'])->name('signup');

Route::post('/logout', [UserController::class, 'logout'])->middleware('is_auth')->name('logout');

Route::get('/e-trak', [EtrakController::class, 'index'])->middleware('is_auth')->name('e-trak');

Route::get('/e-trak/view-records', [EtrakController::class, 'view_records'])->middleware('is_auth')->name('view-records');
Route::get('/e-trak/view-records/get', [EtrakController::class, 'search_graduates'])->middleware('is_auth')->name('search-graduates');

Route::get('/e-trak/create-record', [EtrakController::class, 'create_record_page'])->middleware('is_auth')->name('create-record-page');
Route::post('/e-trak/create-record/post', [EtrakController::class, 'create_record'])->middleware('is_auth')->name('create-record');

Route::get('/e-trak/record-details/{graduate}', [EtrakController::class, 'record_details'])->middleware('is_auth')->name('record-details');

Route::get('/e-trak/update-record/{graduate}', [EtrakController::class, 'update_record_page'])->middleware('is_auth')->name('update-record-page');
Route::put('/e-trak/update-record/{graduate}/put', [EtrakController::class, 'update_record'])->middleware('is_auth')->name('update-record');

Route::delete('/e-trak/record-details/{graduate}/delete', [EtrakController::class, 'delete_record'])->middleware('is_auth')->name('delete-record');

Route::get('/import-excel-file', [ImportExcelFileController::class, 'index'])->middleware('is_auth')->name('import-excel-file-page');
Route::post('/import-excel-file/post', [ImportExcelFileController::class, 'import_excel_file'])->middleware('is_auth')->name('import-excel-file');