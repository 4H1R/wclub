<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperQuestionFormAnswer
 */
class QuestionFormAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFormAnswerFactory> */
    use HasFactory;

    protected $casts = [
        'answers' => 'array',
    ];

    public function questionForm(): BelongsTo
    {
        return $this->belongsTo(QuestionForm::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
