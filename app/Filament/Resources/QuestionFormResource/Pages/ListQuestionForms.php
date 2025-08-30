<?php

namespace App\Filament\Resources\QuestionFormResource\Pages;

use App\Filament\Resources\QuestionFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestionForms extends ListRecords
{
    protected static string $resource = QuestionFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
