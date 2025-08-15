<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Models\QuestionForm;
use App\Models\User;

class QuestionFormPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyQuestionForms);
    }

    public function view(User $user, QuestionForm $questionForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::ViewAnyQuestionForms);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(PermissionEnum::CreateQuestionForms);
    }

    public function update(User $user, QuestionForm $questionForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::UpdateAnyQuestionForms);
    }

    public function delete(User $user, QuestionForm $questionForm): bool
    {
        return $user->hasPermissionTo(PermissionEnum::DeleteAnyQuestionForms);
    }

    public function restore(User $user, QuestionForm $questionForm): bool
    {
        return false;
    }

    public function forceDelete(User $user, QuestionForm $questionForm): bool
    {
        return false;
    }
}
