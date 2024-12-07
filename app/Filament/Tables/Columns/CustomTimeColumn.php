<?php

namespace App\Filament\Tables\Columns;

use Carbon\Carbon;
use Filament\Tables\Columns\TextColumn;

class CustomTimeColumn
{
    public static function formatDate(string $date): string
    {
        if (app()->currentLocale() === 'fa') {
            // @phpstan-ignore-next-line
            return verta($date)->formatJalaliDatetime();
        }

        return Carbon::parse($date)->toDateTimeString();
    }

    public static function make(string $name): TextColumn
    {
        return TextColumn::make($name)
            ->sortable()
            ->toggleable()
            ->formatStateUsing(fn ($state) => $state ? static::formatDate($state) : null);
    }
}
