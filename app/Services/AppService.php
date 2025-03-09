<?php

namespace App\Services;

use Illuminate\Http\Response;
use Spatie\Honeypot\Events\SpamDetectedEvent;
use Spatie\Honeypot\Exceptions\SpamException;
use Spatie\Honeypot\SpamProtection;

class AppService
{
    public function isLocalStrict(): bool
    {
        return app()->isLocal()
            && app()->hasDebugModeEnabled()
            && str_contains(config('app.url'), 'localhost');
    }

    public function canPassHoneypot(): bool
    {
        try {
            app(SpamProtection::class)->check(request()->all());

            return true;
        } catch (SpamException) {
            event(new SpamDetectedEvent(request()));

            return false;
        }
    }

    public function getHoneypotResponse(): Response
    {
        return response('');
    }
}
