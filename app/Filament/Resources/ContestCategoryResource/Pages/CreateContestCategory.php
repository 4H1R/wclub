<?php

namespace App\Filament\Resources\ContestCategoryResource\Pages;

use App\Filament\Resources\ContestCategoryResource;
use App\Models\Contest;
use Filament\Resources\Pages\CreateRecord;

class CreateContestCategory extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['model'] = Contest::class;

        return $data;
    }

    protected static string $resource = ContestCategoryResource::class;
}
