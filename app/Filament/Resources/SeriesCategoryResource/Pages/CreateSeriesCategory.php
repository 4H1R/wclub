<?php

namespace App\Filament\Resources\SeriesCategoryResource\Pages;

use App\Filament\Resources\SeriesCategoryResource;
use App\Models\Series;
use Filament\Resources\Pages\CreateRecord;

class CreateSeriesCategory extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['model'] = Series::class;

        return $data;
    }

    protected static string $resource = SeriesCategoryResource::class;
}
