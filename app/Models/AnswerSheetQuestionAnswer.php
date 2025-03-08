<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnswerSheetQuestionAnswer extends Model
{
    use HasFactory;
    public function answer_sheet_question(): BelongsTo
    {
        return $this->belongsTo(AnswerSheetQuestion::class);
    }
}
