<?php

namespace App\Filament\Resources\EventProgramResource\Pages;

use App\Filament\Resources\EventProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventProgram extends EditRecord
{
    protected static string $resource = EventProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
