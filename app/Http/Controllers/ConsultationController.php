<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ConsultationController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('consultations/Index');
    }

    public function inPerson(): \Inertia\Response
    {
        return Inertia::render('consultations/InPerson');
    }
}
