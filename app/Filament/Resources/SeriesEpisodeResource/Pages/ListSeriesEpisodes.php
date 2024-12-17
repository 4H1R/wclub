<?php

namespace App\Filament\Resources\SeriesEpisodeResource\Pages;

use App\Filament\Resources\SeriesEpisodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeriesEpisodes extends ListRecords
{
    protected static string $resource = SeriesEpisodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
