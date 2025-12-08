<?php

namespace App\Http\Controllers\EventProgram;

use App\Http\Controllers\Controller;
use App\Models\EventProgram;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EventProgramRegistrationController extends Controller
{
    public function store(EventProgram $eventProgram): RedirectResponse
    {
        abort_unless($eventProgram->published_at, 403);
        abort_unless(Carbon::parse($eventProgram->finished_at)->gt(now()), 403);

        $eventProgram->registrations()->syncWithoutDetaching([Auth::id()]);

        return back();
    }
}
