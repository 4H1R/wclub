<?php

namespace App\Filament\Resources\QuestionFormAnswerResource\Pages;

use App\Filament\Resources\QuestionFormAnswerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionFormAnswer extends EditRecord
{
    protected static string $resource = QuestionFormAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
