<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestQuestionAnswers extends Model
{
    protected $table = 'test_question_answers';
    protected $fillable = ['test_id','question_id','answer_id',];
}
