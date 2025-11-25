<?php

namespace App\Http\Controllers;

use App\Data\QuestionForm\QuestionFormFullData;
use App\Models\QuestionForm;
use App\Models\QuestionFormAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class QuestionFormController extends Controller
{
    public function show(QuestionForm $questionForm): \Inertia\Response|RedirectResponse
    {
        abort_unless($questionForm->model->canAnswerQuestionForm(), 404);

        if (QuestionFormAnswer::where('question_form_id', $questionForm->id)->where('user_id', Auth::id())->exists()) {
            return to_route('contests.show', [$questionForm->model, 'question-form-answered' => 1]);
        }

        return Inertia::render('questionForms/Show', [
            'question_form' => QuestionFormFullData::from($questionForm),
        ]);
    }

    public function store(Request $request, QuestionForm $questionForm): RedirectResponse
    {
        abort_unless($questionForm->model->canAnswerQuestionForm(), 404);

        if (QuestionFormAnswer::where('question_form_id', $questionForm->id)->where('user_id', Auth::id())->exists()) {
            return to_route('contests.show', [$questionForm->model, 'question-form-answered' => 1]);
        }

        $validations = collect($questionForm->questions)->reduce(function (array $carry, array $question) {
            $options = collect($question['properties']['options'])->pluck('value')->toArray();
            $carry['answers.'.$question['id']] = ['required', 'string', Rule::in($options)];

            return $carry;
        }, []);

        $validated = $request->validate([
            'answers' => ['required', 'array'],
            ...$validations,
        ]);

        $score = collect($questionForm->questions)->reduce(function (int $carry, array $question) use ($validated) {
            $carry += collect($question['properties']['options'])->firstWhere('value', $validated['answers'][$question['id']])['score'];

            return $carry;
        }, 0);

        QuestionFormAnswer::create([
            'question_form_id' => $questionForm->id,
            'user_id' => Auth::id(),
            'score' => $score,
            'answers' => $validated['answers'],
        ]);

        return to_route('contests.show', [$questionForm->model, 'question-form-answered' => 1]);
    }
}
