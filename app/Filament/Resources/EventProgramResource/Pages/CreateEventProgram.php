<?php

namespace App\Filament\Resources\EventProgramResource\Pages;

use App\Filament\Resources\EventProgramResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateEventProgram extends CreateRecord
{
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();

        return $data;
    }

    protected static string $resource = EventProgramResource::class;
}
