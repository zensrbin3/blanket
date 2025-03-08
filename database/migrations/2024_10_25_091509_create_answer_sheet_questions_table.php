<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerSheetQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_sheet_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('answer_sheet_id')->unsigned();
            $table->foreign('answer_sheet_id')->references('id')->on('answer_sheets')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ordinal');
            $table->string('question_description');
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
        Schema::dropIfExists('answer_sheet_questions');
    }
}
