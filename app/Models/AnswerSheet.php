<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnswerSheet extends Model
{
    use HasFactory;
    public function answer_sheet_question(): HasMany
    {
        return $this->hasMany(AnswerSheetQuestion::class);
    }
}
