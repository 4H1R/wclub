<?php

namespace App\Filament\Resources\RewardProgramCategoryResource\Pages;

use App\Filament\Resources\RewardProgramCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRewardProgramCategory extends EditRecord
{
    protected static string $resource = RewardProgramCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
