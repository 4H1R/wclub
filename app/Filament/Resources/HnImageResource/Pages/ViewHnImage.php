<?php

namespace App\Filament\Resources\HnImageResource\Pages;

use App\Filament\Resources\HnImageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHnImage extends ViewRecord
{
    protected static string $resource = HnImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
