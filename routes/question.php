<?php
use Illuminate\Support\Facades\Route;
Route::middleware('auth')->group(function () {
    Route::get("/question/create", [\App\Http\Controllers\QuestionController::class, "create"])->name("question.create");
    Route::post("/question/store", [\App\Http\Controllers\QuestionController::class, "store"])->name("question.store");
    Route::get("/question/index", [\App\Http\Controllers\QuestionController::class, "index"])->name("question.index");
    Route::get("/question/show/{question}", [\App\Http\Controllers\QuestionController::class, "show"])->name("question.show");
    Route::get("/question/edit/{question}", [\App\Http\Controllers\QuestionController::class, "edit"])->name("question.edit");
    Route::post("/question/update/{question}", [\App\Http\Controllers\QuestionController::class, "update"])->name("question.update");
    Route::get("/question/destroy/{question}", [\App\Http\Controllers\QuestionController::class, "destroy"])->name("question.destroy");
});

