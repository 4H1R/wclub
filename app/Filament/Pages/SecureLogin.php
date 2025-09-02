<?php

namespace App\Filament\Pages;

use App\Services\SiemLoggerService;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;
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

        return $this->login();
    }

    public function login(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (
            ($user instanceof FilamentUser) &&
            (! $user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        app(SiemLoggerService::class)->log(SiemLogIdEnum::LoginSuccess, 'Login successful');

        return app(LoginResponse::class);
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
