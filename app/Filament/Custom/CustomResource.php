<?php

namespace App\Filament\Custom;

use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomResource extends Resource
{
    protected static string $translationLabel = '';

    /**
     * @return string[]
     */
    public static function getTranslatableLocales(): array
    {
        return config('app.supported_locales');
    }

    /**
     * @return Builder<Model>
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes();
    }

    public static function getModelLabel(): string
    {
        return trans_choice(static::$translationLabel, 1);
    }

    public static function getPluralLabel(): ?string
    {
        return trans_choice(static::$translationLabel, 2);
    }
}
