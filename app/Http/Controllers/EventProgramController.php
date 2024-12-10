<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class EventProgramController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('eventPrograms/Index');
    }
}
