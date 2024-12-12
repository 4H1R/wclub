<?php

namespace App\Filament\Resources\EventProgramCategoryResource\Pages;

use App\Filament\Resources\EventProgramCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventProgramCategory extends EditRecord
{
    protected static string $resource = EventProgramCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
