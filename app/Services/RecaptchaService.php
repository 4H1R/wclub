<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecaptchaService
{
    public function verify(string $token): bool
    {
        $response = Http::asForm()
            ->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => config('services.recaptcha.secret_key'),
                'response' => $token,
                'remoteip' => request()->ip(),
            ]);

        if ($response->failed()) {
            return false;
        }

        $data = $response->json();

        return $data['success'] && $data['score'] >= config('services.recaptcha.minimum_score');
    }
}
