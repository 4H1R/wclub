<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactUsController extends Controller
{
    public function __invoke(Request $request): \Inertia\Response
    {
        return Inertia::render('ContactUs');
    }
}
