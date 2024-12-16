<?php

namespace App\Filament\Resources\ContestCategoryResource\Pages;

use App\Filament\Resources\ContestCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContestCategory extends EditRecord
{
    protected static string $resource = ContestCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
