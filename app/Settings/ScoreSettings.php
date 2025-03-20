<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ScoreSettings extends Settings
{
    public array $score_to_coupon_logic;

    public static function group(): string
    {
        return 'score';
    }
}
