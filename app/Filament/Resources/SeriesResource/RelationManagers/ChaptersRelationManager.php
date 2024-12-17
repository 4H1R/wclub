<?php

namespace App\Filament\Resources\SeriesResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\SeriesChapterResource;

class ChaptersRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'chapters';

    protected static ?string $resource = SeriesChapterResource::class;
}
