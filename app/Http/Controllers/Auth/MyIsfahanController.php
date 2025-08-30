<?php

namespace App\Http\Controllers\Auth;

use App\Data\Auth\IsfahanSsoCitizenData;
use App\Enums\Auth\IsfahanSSOAuthLevelEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AppService;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MyIsfahanController extends Controller
{
    public function __construct(private readonly AppService $appService) {}

    public function redirect(): RedirectResponse
    {
        $callbackUrl = route('auth.my-isfahan.callback');

        $url = sprintf(
            'http://isfsso.isfahan.ir/SystemAuth/Authorize?client_id=%s&aut_level=%s&redirect_uri=%s',
            config('services.isfahan_sso.client_id'),
            IsfahanSSOAuthLevelEnum::AuthorizedMobileAndNationalCode,
            $callbackUrl,
        );

        return redirect($url);
    }

    public function callback(Request $request): RedirectResponse
    {
        $code = $request->input('code');

        if (! $code) {
            return to_route('auth', ['error' => '1']);
        }

        try {
            $token = $this->getApiToken();
            $data = $this->getCitizenInfo($token, $code);

            $user = User::updateOrCreate(
                ['national_code' => $data->citizenNationalCode],
                [
                    'first_name' => $data->citizenFirstName,
                    'last_name' => $data->citizenLastName,
                    'phone' => $data->citizenMobile,
                    'phone_verified_at' => now(),
                    'birth_date' => Verta::parse('1383-01-22')->datetime(),
                    'password' => Str::password(16),
                ]
            );

            Auth::login($user, true);

            return to_route('dashboard', ['auth_was_successful' => true]);
        } catch (\Exception $e) {
            report($e);

            return to_route('auth', ['error' => '1']);
        }
    }

    private function getApiToken(): string
    {
        $isfahan = config('services.isfahan_sso');

        $response = Http::asJson()
            ->withoutVerifying()
            ->post('https://isfsso.isfahan.ir/api/Authenticate/login', [
                'username' => $isfahan['client_id'],
                'password' => $isfahan['secret'],
            ]);

        return $response->json('token');
    }

    private function getCitizenInfo(string $token, string $oneTimeCode): IsfahanSsoCitizenData
    {
        $response = Http::withToken($token)
            ->asMultipart()
            ->withoutVerifying()
            ->post('https://isfsso.isfahan.ir/api/Citizens/GetCitizenInfo', [
                'code' => $oneTimeCode,
            ]);

        $data = $response->json();

        return IsfahanSsoCitizenData::from($data);
    }
}
