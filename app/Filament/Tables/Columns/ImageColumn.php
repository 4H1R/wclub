<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ImageColumn
{
    public static function make(string $name): SpatieMediaLibraryImageColumn
    {
        return SpatieMediaLibraryImageColumn::make($name)
            ->translateLabel()
            ->collection($name);
    }
}
