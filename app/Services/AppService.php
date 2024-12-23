<?php

namespace App\Services;

class AppService
{
    public function isLocalStrict(): bool
    {
        return app()->isLocal()
            && app()->hasDebugModeEnabled()
            && str_contains(config('app.url'), 'localhost');
    }
}
