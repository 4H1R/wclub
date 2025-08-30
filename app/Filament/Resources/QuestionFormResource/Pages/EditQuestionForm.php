<?php

namespace App\Filament\Resources\QuestionFormResource\Pages;

use App\Filament\Resources\QuestionFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuestionForm extends EditRecord
{
    protected static string $resource = QuestionFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
