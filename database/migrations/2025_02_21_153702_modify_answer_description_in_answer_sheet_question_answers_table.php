<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAnswerDescriptionInAnswerSheetQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answer_sheet_question_answers', function (Blueprint $table) {
            $table->text('answer_description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_sheet_question_answers', function (Blueprint $table) {
            $table->string('answer_description')->change();
        });
    }
}
