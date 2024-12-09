<?php

namespace App\Filament\Resources\RewardProgramCategoryResource\Pages;

use App\Filament\Resources\RewardProgramCategoryResource;
use App\Models\RewardProgram;
use Filament\Resources\Pages\CreateRecord;

class CreateRewardProgramCategory extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['model'] = RewardProgram::class;

        return $data;
    }

    protected static string $resource = RewardProgramCategoryResource::class;
}
