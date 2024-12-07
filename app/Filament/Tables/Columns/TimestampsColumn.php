<?php

namespace App\Filament\Tables\Columns;

class TimestampsColumn
{
    /**
     * @return mixed[]
     */
    public static function make(): array
    {
        return [
            CustomTimeColumn::make('created_at')->translateLabel(),
            CustomTimeColumn::make('updated_at')->translateLabel(),
        ];
    }
}
