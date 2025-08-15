<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
