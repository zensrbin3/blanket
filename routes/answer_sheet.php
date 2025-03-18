<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth','admin'])->group(function () {

    Route::get('/answer_sheet/index', function () {
        return view('answer_sheet.index');
    })->name('answer_sheet.index');

    Route::get("/answer_sheet/create", [\App\Http\Controllers\AnswerSheetController::class, "create"])->name("answer_sheet.create");
    Route::post("/answer_sheet/store", [\App\Http\Controllers\AnswerSheetController::class, "store"])->name("answer_sheet.store");
    Route::get("/answer_sheet/index", [\App\Http\Controllers\AnswerSheetController::class, "index"])->name("answer_sheet.index");
    Route::get("/answer_sheet/show/{answer_sheet}/{full}", [\App\Http\Controllers\AnswerSheetController::class, "show"])->name("answer_sheet.show");
    Route::post("/answer_sheet/update", [\App\Http\Controllers\AnswerSheetController::class, "update"])->name("answer_sheet.update");
    Route::get("/answer_sheet/find", [\App\Http\Controllers\AnswerSheetController::class, "find"])->name("answer_sheet.find");
    Route::get("/answer_sheet/destroy/{answer_sheet}", [\App\Http\Controllers\AnswerSheetController::class, "destroy"])->name("answer_sheet.destroy");
});
