<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/test', [TestController::class, 'index'])
    ->name('test.index');

Route::get('/test/show/{test}', [TestController::class, 'show'])
    ->name('test.show');

Route::post('/test/show/{test}/update', [TestController::class, 'update'])
    ->name('test.update');

