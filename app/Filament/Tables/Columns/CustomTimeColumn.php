<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class CustomTimeColumn
{
    public static function formatDate(string $date): string
    {
        return verta($date)->formatJalaliDatetime();
    }

    public static function make(string $name): TextColumn
    {
        return TextColumn::make($name)
            ->sortable()
            ->toggleable()
            ->translateLabel()
            ->formatStateUsing(fn ($state) => $state ? static::formatDate($state) : null);
    }
}
