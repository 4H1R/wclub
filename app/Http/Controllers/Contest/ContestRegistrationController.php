<?php

namespace App\Http\Controllers\Contest;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ContestRegistrationController extends Controller
{
    public function store(Contest $contest): RedirectResponse
    {
        abort_unless($contest->published_at, 403);
        abort_unless(Carbon::parse($contest->finished_at)->gt(now()), 403);

        $contest->registrations()->syncWithoutDetaching([Auth::id()]);

        return back();
    }
}
