<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CampaignController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('campaigns/Index');
    }
}
