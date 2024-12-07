<?php

namespace App\Filament\Forms\Layouts;

use App\Filament\Forms\Components\DateTimePicker;
use Filament\Forms;

class StatusSection
{
    /**
     * @param  array<Forms\Components\Component>  $components
     */
    public static function make(array $components = [], bool $includePublishedAt = false): Forms\Components\Section
    {
        if ($includePublishedAt) {
            array_unshift(
                $components,
                DateTimePicker::make('published_at'),
            );
        }

        return Forms\Components\Section::make(__('Status'))
            ->schema($components);
    }
}
