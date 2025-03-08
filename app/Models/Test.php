<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Test extends Model
{
    use HasFactory;
    protected $table = 'tests';
    protected $fillable = ['answer_sheet_id','user_id','status'];
    public function answerSheet():BelongsTo{
        return $this->belongsTo(AnswerSheet::class);
    }
    public function testQuestionAnswers(): BelongsToMany
    {
        return $this->belongsToMany(AnswerSheetQuestion::class, 'test_question_answers')->withPivot('answer_sheet_question_answer_id');
    }
    public function scopeForUser(Builder $query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
}
