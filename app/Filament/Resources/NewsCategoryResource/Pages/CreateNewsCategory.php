<?php

namespace App\Filament\Resources\NewsCategoryResource\Pages;

use App\Filament\Resources\NewsCategoryResource;
use App\Models\News;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsCategory extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['model'] = News::class;

        return $data;
    }

    protected static string $resource = NewsCategoryResource::class;
}
