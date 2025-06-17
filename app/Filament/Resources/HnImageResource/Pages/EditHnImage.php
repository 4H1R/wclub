<?php

namespace App\Filament\Resources\HnImageResource\Pages;

use App\Filament\Resources\HnImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHnImage extends EditRecord
{
    protected static string $resource = HnImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
