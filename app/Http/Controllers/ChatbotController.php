<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ChatbotController extends Controller
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Chatbot');
    }
}
