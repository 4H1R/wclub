<?php

namespace App\Filament\Resources\HnTextResource\Pages;

use App\Filament\Resources\HnTextResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHnText extends ViewRecord
{
    protected static string $resource = HnTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
