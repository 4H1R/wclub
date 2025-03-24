<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyIsfahanController extends Controller
{
    public function redirect(): RedirectResponse
    {
        // Todo redirect

        return redirect('/auth/my-isfahan/callback');
    }

    public function callback(Request $request): RedirectResponse
    {
        // Todo handle callback
        abort(404);

        Auth::loginUsingId(1, true);

        return to_route('dashboard', ['auth_was_successful' => true]);
    }
}
