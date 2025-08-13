<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RecaptchaService
{
    public function verify(string $token): bool
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $token,
            'remoteip' => request()->ip(),
        ])->json();

        dd($response);

        return $response['success'] && $response['score'] >= config('services.recaptcha.minimum_score');
    }
}
