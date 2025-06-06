<?php

namespace App\Filament\Resources\GardenResource\Pages;

use App\Filament\Resources\GardenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGarden extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['location']);

        return $data;
    }

    protected static string $resource = GardenResource::class;
}
