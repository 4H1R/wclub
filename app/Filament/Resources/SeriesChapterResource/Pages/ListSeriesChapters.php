<?php

namespace App\Filament\Resources\SeriesChapterResource\Pages;

use App\Filament\Resources\SeriesChapterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSeriesChapters extends ListRecords
{
    protected static string $resource = SeriesChapterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
