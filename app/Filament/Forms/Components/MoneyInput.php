<?php

namespace App\Filament\Forms\Components;

use Filament\Forms;
use Filament\Support\RawJs;

class MoneyInput
{
    public static function make(string $name): Forms\Components\TextInput
    {
        return Forms\Components\TextInput::make($name)
            ->translateLabel()
            ->integer()
            ->suffix('تومان')
            ->mask(RawJs::make('$money($input)'))
            ->stripCharacters(',')
            ->minValue(0)
            ->required();
    }
}
