<?php

namespace App\Filament\Resources\HnTextResource\Pages;

use App\Filament\Resources\HnTextResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHnText extends EditRecord
{
    protected static string $resource = HnTextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
