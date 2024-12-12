<?php

namespace App\Filament\Resources\EventProgramCategoryResource\Pages;

use App\Filament\Resources\EventProgramCategoryResource;
use App\Models\EventProgram;
use Filament\Resources\Pages\CreateRecord;

class CreateEventProgramCategory extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['model'] = EventProgram::class;

        return $data;
    }

    protected static string $resource = EventProgramCategoryResource::class;
}
