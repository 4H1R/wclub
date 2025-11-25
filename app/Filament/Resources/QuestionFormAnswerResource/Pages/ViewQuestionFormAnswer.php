<?php

namespace App\Filament\Resources\QuestionFormAnswerResource\Pages;

use App\Filament\Resources\QuestionFormAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuestionFormAnswer extends ViewRecord
{
    protected static string $resource = QuestionFormAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
