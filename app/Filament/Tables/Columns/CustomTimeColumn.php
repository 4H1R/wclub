<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class CustomTimeColumn
{
    public static function make(string $name): TextColumn
    {
        return TextColumn::make($name)
            ->translateLabel()
            ->sortable()
            ->toggleable()
            ->jalaliDateTime();
    }
}
