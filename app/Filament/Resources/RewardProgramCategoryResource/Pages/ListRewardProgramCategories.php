<?php

namespace App\Filament\Resources\RewardProgramCategoryResource\Pages;

use App\Filament\Resources\RewardProgramCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRewardProgramCategories extends ListRecords
{
    protected static string $resource = RewardProgramCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
