<?php

namespace App\Http\Controllers;

use App\Data\ContactUs\RequestContactUsData;
use App\Data\Honeypot\HoneypotData;
use App\Models\ContactUs;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class ContactUsController extends Controller
{
    public function create(): \Inertia\Response
    {
        return Inertia::render('ContactUs', [
            'data' => RequestContactUsData::empty(),
            'hp' => HoneypotData::fromHoneypot(),
        ]);
    }

    public function store(RequestContactUsData $data): RedirectResponse
    {
        ContactUs::create($data->toArray());

        return back();
    }
}
