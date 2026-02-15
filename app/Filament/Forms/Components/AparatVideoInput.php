<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\TextInput;

class AparatVideoInput
{
    public static function make(): TextInput
    {
        return TextInput::make('aparat_video_hash')
            ->label('هش ویدیو آپارات')
            ->maxLength(255);
    }
}
