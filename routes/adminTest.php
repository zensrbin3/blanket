<?php

use App\Http\Controllers\AdminTestController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
    Route::get('testAdmin/add',[AdminTestController::class, 'index'])
        ->name('admin.test.add');
});
