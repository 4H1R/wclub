<?php

namespace App\Http\Controllers;

use App\Data\ContactUs\RequestContactUsData;
use App\Data\Honeypot\HoneypotData;
use App\Models\ContactUs;
use App\Services\AppService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Inertia\Inertia;

class ContactUsController extends Controller
{
    public function __construct(private readonly AppService $appService) {}

    public function create(): \Inertia\Response
    {
        return Inertia::render('ContactUs', [
            'data' => RequestContactUsData::empty(),
            'hp' => HoneypotData::fromHoneypot(),
        ]);
    }

    public function store(RequestContactUsData $data): RedirectResponse|Response
    {
        if (! $this->appService->canPassHoneypot()) {
            return $this->appService->getHoneypotResponse();
        }

        ContactUs::create($data->toArray());

        return back();
    }
}
