<?php

namespace App\Filament\Resources\HnImageResource\Pages;

use App\Filament\Resources\HnImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHnImages extends ListRecords
{
    protected static string $resource = HnImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
