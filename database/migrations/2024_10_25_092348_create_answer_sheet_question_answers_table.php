<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerSheetQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_sheet_question_answers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('answer_sheet_question_id')->unsigned();
            $table->foreign('answer_sheet_question_id')->references('id')->on('answer_sheet_questions')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ordinal');
            $table->string('answer_description');
            $table->boolean('is_correct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_sheet_question_answers');
    }
}
