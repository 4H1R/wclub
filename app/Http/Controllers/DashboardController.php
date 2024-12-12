<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function show(): \Inertia\Response
    {
        return Inertia::render('dashboard/Show');
    }
}
