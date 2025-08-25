<?php

namespace App\Filament\Pages;

use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class SecureLogin extends Login
{
    protected static string $view = 'pages.auth.login';

    public string $hCaptchaToken = '';

    public function authenticate(): ?LoginResponse
    {
        if (! $this->verifyHCaptcha()) {
            $this->resetCaptcha();
            throw ValidationException::withMessages([
                'data.email' => 'ریکپچا نامعتبر است. لطفا دوباره تلاش کنید.',
            ]);
        }

        return parent::authenticate();
    }

    protected function throwFailureValidationException(): never
    {
        $this->resetCaptcha();
        parent::throwFailureValidationException();
    }

    protected function resetCaptcha(): void
    {
        $this->hCaptchaToken = '';
        $this->js('resetHCaptcha()');
    }

    protected function getViewData(): array
    {
        return array_merge(parent::getViewData(), [
            'hcaptchaSiteKey' => config('services.hcaptcha.site_key'),
        ]);
    }

    protected function verifyHCaptcha(): bool
    {
        if (! $this->hCaptchaToken) {
            return false;
        }

        $response = Http::asForm()->post('https://api.hcaptcha.com/siteverify', [
            'secret' => config('services.hcaptcha.secret_key'),
            'sitekey' => config('services.hcaptcha.site_key'),
            'response' => $this->hCaptchaToken,
            'remoteip' => request()->ip(),
        ]);

        return $response->successful() && $response->json('success', false);
    }
}
