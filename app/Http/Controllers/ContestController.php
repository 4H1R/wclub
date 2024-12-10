<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ContestController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('contests/Index');
    }
}
