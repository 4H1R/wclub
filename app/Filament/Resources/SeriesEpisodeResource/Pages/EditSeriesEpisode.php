<?php

namespace App\Filament\Resources\SeriesEpisodeResource\Pages;

use App\Filament\Resources\SeriesEpisodeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeriesEpisode extends EditRecord
{
    protected static string $resource = SeriesEpisodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
