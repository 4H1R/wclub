<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendAuthSms;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
                $token = $this->authService->generateNumericToken();

                // SendAuthSms::dispatch($validated['phone'], (string) $token);

                DB::table('generated_tokens')->updateOrInsert(
                    ['id' => $validated['phone']],
                    ['token' => $token, 'created_at' => now()]
                );
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

        $isValid = false;

        $isExecuted = RateLimiter::attempt(
            sprintf('verify-sms:%s#%s', $validated['phone'], $request->ip()),
            3,
            function () use (&$isValid) {
                $isValid = $this->isTokenValid();
            },
            120,
        );

        if (! $isExecuted) {
            throw ValidationException::withMessages(['message' => 'شما تعداد زیادی کد نادرست به این حساب فرستاده اید.']);
        }

        if (! $isValid) {
            throw ValidationException::withMessages(['message' => 'کد وارد صحیح نیست.']);
        }

        $user = User::where('phone', $validated['phone'])->first();

        if ($user) {
            $this->handleLogin($user->id);

            return $this->redirectToDashboard();
        }

        return back();
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->getValidations()->toArray());

        $isValid = $this->isTokenValid();

        if (! $isValid) {
            DB::table('generated_tokens')
                ->where('id', $validated['phone'])
                ->delete();

            throw ValidationException::withMessages(['message' => 'کد وارد شده منقضی شده لطفا دوباره کد جدید بگیرید.']);
        }

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'phone' => $validated['phone'],
            'phone_verified_at' => now(),
            'birth_date' => $validated['birth_date'],
            'password' => Str::password(16),
        ]);

        event(new Registered($user));

        $this->handleLogin($user->id);

        return $this->redirectToDashboard();
    }

    /**
     * @return Collection<string,mixed>
     */
    private function getValidations(): Collection
    {
        return collect([
            'phone' => ['required', 'regex:'.AuthService::phoneRegex],
            'token' => ['required', 'numeric', 'digits:4'],
            'first_name' => ['required', 'string', 'min:3', 'max:255'],
            'last_name' => ['required', 'string', 'min:3', 'max:255'],
            'birth_date' => ['required', 'date', 'before:'.now()->subYears(5)->toDateString()],
            'email' => ['bail', 'nullable', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
        ]);
    }

    protected function handleLogin(int $userId): void
    {
        Auth::loginUsingId($userId, true);

        request()->session()->regenerate();
    }

    private function isTokenValid(): bool
    {
        return DB::table('generated_tokens')
            ->where('id', request('phone'))
            ->where('token', request('token'))
            ->where('created_at', '>', now()->subMinutes(5))
            ->exists();
    }

    protected function redirectToDashboard(): RedirectResponse
    {
        return to_route('dashboard', ['auth_was_successful' => true]);
    }
}
