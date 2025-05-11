<?php

namespace App\Filament\Resources\EventProgramResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\FaqResource;

class FaqsRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'faqs';

    protected static ?string $resource = FaqResource::class;
}
