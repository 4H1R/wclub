<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SmsController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    /**
     * @throws ValidationException
     */
    public function send(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->getValidations()->only('phone')->toArray());

        $isExecuted = RateLimiter::attempt(
            $key = 'send-sms:'.$request->ip(),
            2,
            function () use ($validated) {
                $this->authService->sendTokenToPhone($validated['phone']);
                // sent
            },
        );

        if (! $isExecuted) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages(['message' => sprintf('شما درخواست کد جدید را در %d ثانیه دارید', $seconds)]);
        }

        return back();
    }

    /**
     * @throws ValidationException
     */
    public function verify(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->getValidations()->only('phone', 'token')->toArray());

        $refreshToken = null;

        $isExecuted = RateLimiter::attempt(
            sprintf('verify-sms:%s#%s', $validated['phone'], $request->ip()),
            3,
            function () use (&$refreshToken, $validated) {
                $refreshToken = $this->authService->validateTokenAndGetRefreshToken($validated['phone'], (int) $validated['token']);
            },
            120,
        );

        if (! $isExecuted) {
            throw ValidationException::withMessages(['message' => 'شما تعداد زیادی کد نادرست به این حساب فرستاده اید.']);
        }

        if (! $refreshToken) {
            throw ValidationException::withMessages(['message' => 'کد وارد صحیح نیست.']);
        }

        $data = $this->authService->getUserInfo($refreshToken);

        if ($data instanceof string) {
            throw ValidationException::withMessages(['message' => $data]);
        }

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

        $request->session()->regenerate();

        return to_route('dashboard', ['auth_was_successful' => true]);
    }

    /**
     * @return Collection<string,mixed>
     */
    private function getValidations(): Collection
    {
        return collect([
            'phone' => ['required', 'regex:'.AuthService::phoneRegex],
            'token' => ['required', 'numeric', 'digits:4'],
        ]);
    }
}
