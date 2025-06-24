<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CleanLifeController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('CleanLife');
    }
}
