<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutUsController extends Controller
{
    public function __invoke(Request $request): \Inertia\Response
    {
        return Inertia::render('AboutUs');
    }
}
