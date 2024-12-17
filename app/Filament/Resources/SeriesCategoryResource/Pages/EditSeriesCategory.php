<?php

namespace App\Filament\Resources\SeriesCategoryResource\Pages;

use App\Filament\Resources\SeriesCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeriesCategory extends EditRecord
{
    protected static string $resource = SeriesCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
