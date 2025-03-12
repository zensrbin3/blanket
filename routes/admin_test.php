<?php

use App\Http\Controllers\AdminTestController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
    Route::get('testAdmin/index',[AdminTestController::class, 'index'])
        ->name('admin.test.index');
    Route::post('testAdmin/index',[AdminTestController::class, 'store'])
        ->name('admin.test.store');
});
