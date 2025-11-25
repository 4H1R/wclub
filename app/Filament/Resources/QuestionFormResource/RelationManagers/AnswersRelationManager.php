<?php

namespace App\Filament\Resources\QuestionFormResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\QuestionFormAnswerResource;

class AnswersRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'answers';

    protected static ?string $resource = QuestionFormAnswerResource::class;
}
