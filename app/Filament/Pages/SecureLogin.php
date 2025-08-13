<?php

namespace App\Filament\Pages;

use App\Services\RecaptchaService;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login;

class SecureLogin extends Login
{
    protected static string $view = 'pages.auth.login';

    public string $recaptchaToken = '';

    // public function authenticate(): ?LoginResponse
    // {
    //     $result = app(RecaptchaService::class)->verify($this->recaptchaToken);

    //     return parent::authenticate();
    // }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'recaptchaSiteKey' => config('services.recaptcha.site_key'),
        ]);
    }
}
