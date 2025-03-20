<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('score.score_to_coupon_logic', [['score_amount' => 500, 'coupon_amount' => 50_000]]);
    }
};
