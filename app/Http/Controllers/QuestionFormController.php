<?php

namespace App\Http\Controllers;

use App\Models\QuestionForm;

class QuestionFormController extends Controller
{
    public function show(QuestionForm $questionForm): Inertia\Response
    {
        return Inertia::render('QuestionForm/Show', [
            'questionForm' => $questionForm,
        ]);
    }
}
