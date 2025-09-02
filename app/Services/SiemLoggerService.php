<?php

namespace App\Services;

use App\Enums\Logger\SeimLogIdEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SiemLoggerService
{
    protected Request $request;

    protected string $logChannel = 'siem';

    protected string $appName = 'Wclub';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function log(SeimLogIdEnum $logId, string $message, array $context = []): void
    {
        try {
            $header = $this->buildHeader();
            $body = $this->buildBody($logId, $message, $context);
            $logString = sprintf(
                '%s %s: %s',
                $header['timestamp'],
                $header['appName'],
                $body
            );
            Log::channel($this->logChannel)->info($logString);
        } catch (\Exception $e) {
            Log::error('Failed to write to SIEM log channel: '.$e->getMessage());
        }
    }

    private function buildHeader(): array
    {
        return [
            'timestamp' => now()->format('M d H:i:s'),
            'appName' => $this->appName,
        ];
    }

    private function buildBody(SeimLogIdEnum $logId, string $message, array $context): string
    {
        $user = Auth::user() ?? $this->request->user();

        $bodyParts = [
            'date' => now()->format('Y-m-d'),
            'Time' => now()->format('H:i:s'),
            'logid' => $logId->value,
            'Msg' => $message,
            'ServerIP' => $this->request->server('SERVER_ADDR', '127.0.0.1'),
            'ServerPort' => $this->request->server('SERVER_PORT', 80),
            'ServerName' => $this->appName,
            'ClientIP' => $this->request->ip(),
            'ClientPort' => $this->request->server('REMOTE_PORT'),
            'Username' => $user->email ?? $user->phone ?? $user->national_code ?? $context['Username'] ?? 'Guest',
        ];

        $bodyParts = array_merge($bodyParts, $context);
        $formattedBody = [];

        foreach ($bodyParts as $key => $value) {
            $formattedBody[] = sprintf('%s="%s"', $key, (string) $value);
        }

        return implode(', ', $formattedBody);
    }
}
