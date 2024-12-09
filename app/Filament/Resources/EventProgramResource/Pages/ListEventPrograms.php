<?php

namespace App\Filament\Resources\EventProgramResource\Pages;

use App\Filament\Resources\EventProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventPrograms extends ListRecords
{
    protected static string $resource = EventProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
