<?php

namespace App\Filament\Forms\Components;

use Filament\Forms;
use Spatie\MediaLibrary\HasMedia;

class FileInput
{
    public static function make(Forms\Form $form, string $name, bool $isMultiple = false, string $visibility = 'private'): Forms\Components\SpatieMediaLibraryFileUpload
    {
        return Forms\Components\SpatieMediaLibraryFileUpload::make($name)
            ->collection($name)
            ->translateLabel()
            ->deleteUploadedFileUsing(function (string $file) use ($name, $form) {
                if (! $file) {
                    return;
                }

                /** @var HasMedia $record */
                $record = $form->getRecord();
                $record
                    ->media()
                    ->where('collection_name', $name)
                    ->where('uuid', $file)
                    ->first()
                    ?->delete();
            })
            ->disk($visibility === 'private' ? 's3_private' : 's3_public')
            ->visibility($visibility)
            ->multiple($isMultiple)
            ->reorderable($isMultiple)
            ->openable()
            ->downloadable();
    }
}
