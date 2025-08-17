<?php

namespace App\Filament\Pages;

use App\Services\RecaptchaService;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login;
use Illuminate\Validation\ValidationException;

class SecureLogin extends Login
{
    protected static string $view = 'pages.auth.login';

    public string $recaptchaToken = '';

    public function authenticate(): ?LoginResponse
    {
        if (! app(RecaptchaService::class)->verify($this->recaptchaToken)) {
            throw ValidationException::withMessages([
                'data.email' => 'ریکپچا نامعتبر است. لطفا دوباره تلاش کنید.',
            ]);
        }

        return parent::authenticate();
    }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'recaptchaSiteKey' => config('services.recaptcha.site_key'),
        ]);
    }
}
