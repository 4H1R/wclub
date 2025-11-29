<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ImageColumn
{
    public static function make(string $name, string $visibility = 'private'): SpatieMediaLibraryImageColumn
    {
        return SpatieMediaLibraryImageColumn::make($name)
            ->translateLabel()
            ->collection($name)
            ->disk($visibility === 'private' ? 's3_private' : 's3_public')
            ->visibility($visibility);
    }
}
