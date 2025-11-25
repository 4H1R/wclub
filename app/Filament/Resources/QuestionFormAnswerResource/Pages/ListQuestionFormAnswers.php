<?php

namespace App\Filament\Resources\QuestionFormAnswerResource\Pages;

use App\Filament\Resources\QuestionFormAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionFormAnswers extends ListRecords
{
    protected static string $resource = QuestionFormAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
