<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_question_answers', function (Blueprint $table) {
           $table->id();
           $table->bigInteger('test_id')->unsigned();
           $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade')->onUpdate('cascade');
           $table->bigInteger('answer_sheet_question_id')->unsigned();
           $table->foreign('answer_sheet_question_id')->references('id')->on('answer_sheet_questions')->onDelete('cascade')->onUpdate('cascade');
           $table->bigInteger('answer_sheet_question_answer_id')->unsigned();
           $table->foreign('answer_sheet_question_answer_id')->references('id')->on('answer_sheet_question_answers')->onDelete('cascade')->onUpdate('cascade');
           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_question_answers');
    }
};
