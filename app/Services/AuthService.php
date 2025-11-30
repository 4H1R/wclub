<?php

namespace App\Services;

use App\Data\Auth\IsfahanSsoCitizenData;
use App\Enums\Auth\IsfahanSSOAuthLevelEnum;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public const phoneRegex = '/^[0][9][0-9]{9,9}$/';

    private string $baseUrl = 'https://isfssoapi.isfahan.ir/api';

    public function __construct(private readonly CacheService $cacheService) {}

    public function getBearerToken(): string
    {
        return Cache::remember('isfahan_sso_token', now()->addHours(3), function () {
            $resp = $this->getClient()->post('/Authenticate/login', [
                'username' => config('services.isfahan_sso.client_id'),
                'password' => config('services.isfahan_sso.secret'),
            ]);

            return $resp->json('token');
        });
    }

    public function sendTokenToPhone(string $phone): void
    {
        $resp = $this->getClient()
            ->withToken($this->getBearerToken())
            ->post('/Api/GetToken', [
                'mobileNumber' => $phone,
                'authenticationLevel' => IsfahanSSOAuthLevelEnum::AuthorizedMobileAndNationalCode,
                'systemId' => 33,
                'returnURLAddress' => 'https://family.isfahan.ir',
            ]);

        $message = $resp->json('message');

        if ($resp->status() === 400 && $message === 'DolateMan') {
            throw ValidationException::withMessages([
                'message' => 'این شماره در اصفهان من موجود نیست لطفا اول در آنجا ثبت نام کنید.',
            ]);
        }

        $token = $resp->json('token');
        $expiredAt = Carbon::createFromFormat('m/d/Y H:i:s', $resp->json('smsExpireTime'), 'Asia/Tehran');

        Cache::put($this->cacheService->getIsfahanSSOTokenCacheKey($phone), $token, $expiredAt);
    }

    public function validateTokenAndGetRefreshToken(string $phone, int $code): string|false
    {
        $token = Cache::get($this->cacheService->getIsfahanSSOTokenCacheKey($phone));

        if (! $token) {
            return false;
        }

        $resp = $this->getClient()
            ->withToken($this->getBearerToken())
            ->post('/Api/VerifySmsCode', [
                'token' => $token,
                'smsCode' => $code,
            ]);

        return $resp->json('refreshToken', false);
    }

    public function getUserInfo(string $refreshToken): string|IsfahanSsoCitizenData
    {
        $resp = $this->getClient()
            ->withToken($this->getBearerToken())
            ->withBody(sprintf('"%s"', $refreshToken))
            ->post('/Api/CheckedRefreshToken?autLevel='.IsfahanSSOAuthLevelEnum::AuthorizedMobileAndNationalCode);

        $message = $resp->json('message');

        if (Str::contains($message, 'APPLEVEL')) {
            return 'لطفا شماره تلفن و کد ملی خود را برای استفاده از سامانه در اصفهان من تایید کنید.';
        }

        $data = $resp->json('citizenInfo');

        return IsfahanSsoCitizenData::from($data);
    }

    private function getClient(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withoutVerifying()
            ->acceptJson();
    }
}
