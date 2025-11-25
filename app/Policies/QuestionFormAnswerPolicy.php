<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\QuestionFormAnswer;
use App\Models\User;

class QuestionFormAnswerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyQuestionFormAnswers);
    }

    public function view(User $user, QuestionFormAnswer $questionFormAnswer): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, QuestionFormAnswer $questionFormAnswer): bool
    {
        return false;
    }

    public function delete(User $user, QuestionFormAnswer $questionFormAnswer): bool
    {
        return false;
    }

    public function restore(User $user, QuestionFormAnswer $questionFormAnswer): bool
    {
        return false;
    }

    public function forceDelete(User $user, QuestionFormAnswer $questionFormAnswer): bool
    {
        return false;
    }
}
