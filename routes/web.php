<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/admin_test.php';
require __DIR__.'/test.php';
require __DIR__.'/auth.php';
require __DIR__.'/question.php';
require __DIR__.'/answer_sheet.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('layouts.app');
    })->name('layouts.app');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/layouts/app', function () {
        return view('layouts.app');
    })->name('layouts.app');
});

