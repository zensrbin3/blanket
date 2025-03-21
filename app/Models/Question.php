<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Question extends Model
{
    use HasFactory;
    public function answer(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function scopeForQuestion(Builder $builder,$categoryId): Builder{
        return $builder->where('category_id', $categoryId);
    }
}
