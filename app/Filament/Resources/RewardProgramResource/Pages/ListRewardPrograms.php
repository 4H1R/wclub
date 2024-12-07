<?php

namespace App\Filament\Resources\RewardProgramResource\Pages;

use App\Filament\Resources\RewardProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRewardPrograms extends ListRecords
{
    protected static string $resource = RewardProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
