<?php

namespace App\Filament\Resources\SeriesResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\SeriesEpisodeResource;

class EpisodesRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'episodes';

    protected static ?string $resource = SeriesEpisodeResource::class;
}
