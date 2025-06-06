<?php

namespace App\Filament\Forms\Components;

use Filament\Forms;

class DateTimePicker
{
    public static function make(string $name, bool $isJalali = true): Forms\Components\DateTimePicker
    {
        return Forms\Components\DateTimePicker::make($name)
            ->translateLabel()
            ->jalali($isJalali);
    }
}
