<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendAuthSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $phone, public string $token) {}

    public function handle(): void
    {
        $response = Http::post('https://ippanel.com/api/select', [
            'op' => 'pattern',
            'user' => config('services.sms.username'),
            'pass' => config('services.sms.password'),
            'fromNum' => config('services.sms.phone'),
            'toNum' => $this->phone,
            'patternCode' => 'ekczll5nqiv93di',
            'inputData' => [
                ['code' => $this->token],
            ],
        ]);

        info($response->body());
    }
}
