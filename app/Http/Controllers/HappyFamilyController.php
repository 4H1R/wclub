<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HappyFamilyController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('HappyFamily');
    }
}
