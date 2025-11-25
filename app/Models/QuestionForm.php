<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @mixin IdeHelperQuestionForm
 */
class QuestionForm extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFormFactory> */
    use HasFactory;

    protected $casts = [
        'questions' => 'array',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuestionFormAnswer::class);
    }
}
