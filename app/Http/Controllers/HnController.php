<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HnController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('hn/Index');
    }

    public function start(): \Inertia\Response
    {
        return Inertia::render('hn/Start');
    }
}
