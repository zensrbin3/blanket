<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyQuestionDescriptionInAnswerSheetQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answer_sheet_questions', function (Blueprint $table) {
            $table->text('question_description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_sheet_questions', function (Blueprint $table) {
            $table->string('question_description')->change();
        });
    }
}
