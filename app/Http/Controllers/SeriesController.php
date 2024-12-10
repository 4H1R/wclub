<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class SeriesController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('series/Index');
    }
}
