<?php

namespace App\Models\Traits;

use App\Models\QuestionForm;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasQuestionForms
{
    /**
     * @return MorphToMany<QuestionForm>
     */
    public function questionForms(): MorphToMany
    {
        return $this->morphMany(QuestionForm::class, 'model', 'question_form_model');
    }

    abstract public function canAnswerQuestionForm(): bool;
}
