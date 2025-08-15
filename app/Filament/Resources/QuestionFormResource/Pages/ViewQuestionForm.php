<?php

namespace App\Filament\Resources\QuestionFormResource\Pages;

use App\Filament\Resources\QuestionFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuestionForm extends ViewRecord
{
    protected static string $resource = QuestionFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
