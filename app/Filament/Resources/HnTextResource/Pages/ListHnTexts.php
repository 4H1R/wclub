<?php

namespace App\Filament\Resources\HnTextResource\Pages;

use App\Filament\Resources\HnTextResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHnTexts extends ListRecords
{
    protected static string $resource = HnTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
