<?php

namespace App\Filament\Forms\Layouts;

use Filament\Forms;

class TimestampSection
{
    public static function make(): Forms\Components\Section
    {
        return Forms\Components\Section::make(__('Timestamps'))
            ->schema([
                Forms\Components\Placeholder::make('created_at')
                    ->translateLabel()
                    ->content(fn ($record): ?string => $record->created_at?->diffForHumans()),

                Forms\Components\Placeholder::make('updated_at')
                    ->translateLabel()
                    ->content(fn ($record): ?string => $record->updated_at?->diffForHumans()),
            ])
            ->hidden(fn ($record) => $record === null);
    }
}
