<?php

namespace App\Filament\Resources\ContestResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\UserResource;

class UserRegistrationsRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'registrations';

    protected static ?string $resource = UserResource::class;
}
