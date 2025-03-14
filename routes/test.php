<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/test', [TestController::class, 'index'])->name('test.index');
    Route::get('/test/show/{test}', [TestController::class, 'show'])->name('test.show');
    Route::post('/test/show/{test}/update', [TestController::class, 'update'])->name('test.update');
    Route::get('/test/show/{test}/percentage/{numberOfTrueAnswers}/{numberOfQuestions}', [TestController::class, 'percentage'])
        ->name('test.percentage');
    Route::get('/test/currentResult/{test}', [TestController::class, 'currentResult'])
        ->name('test.currentResult');
    Route::get('/test/results/{test}', [TestController::class, 'results'])
        ->name('test.results');
});

