<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnswerSheetQuestion extends Model
{
    use HasFactory;
    public function answer_sheet(): BelongsTo
    {
        return $this->belongsTo(AnswerSheet::class);
    }

    public function answer_sheet_question_answer(): HasMany
    {
        return $this->hasMany(AnswerSheetQuestionAnswer::class);
    }

    public function testAnswer(): HasMany {
        return $this->hasMany(TestQuestionAnswers::class);
    }
}
