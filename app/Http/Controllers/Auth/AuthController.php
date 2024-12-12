<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function show(): \Inertia\Response
    {
        return Inertia::render('Auth');
    }

    public function loginDemo(Request $request): RedirectResponse
    {
        Auth::loginUsingId(1);

        $request->session()->regenerate();

        return to_route('index', ['auth_was_successful' => true]);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
