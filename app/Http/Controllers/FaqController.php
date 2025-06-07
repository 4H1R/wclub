<?php

namespace App\Http\Controllers;

use App\Enums\Faq\FaqStatusEnum;
use App\Models\EventProgram;
use App\Models\Faq;
use App\Models\Scopes\PublishedScope;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class FaqController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'min:3', 'max:1024'],
            'model_id' => ['required', 'integer'],
        ]);

        $eventProgramExists = EventProgram::query()
            ->where('id', $validated['model_id'])
            ->withGlobalScope('published', new PublishedScope)
            ->exists();

        if (! $eventProgramExists) {
            throw ValidationException::withMessages([
                'message' => 'همچین مدلی وجود ندارد',
            ]);
        }

        $faqExists = Faq::query()
            ->where('status', FaqStatusEnum::UnderReview)
            ->where('user_id', Auth::id())
            ->where('model_id', $validated['model_id'])
            ->exists();

        if ($faqExists) {
            throw ValidationException::withMessages([
                'message' => 'شما جدیدا پرسشی ایجاد کرده تا پاسخ به پرسش قبلی لطفا صبر کنید',
            ]);
        }

        $faq = Faq::create([
            'question' => $validated['question'],
            'answer' => '',
            'status' => FaqStatusEnum::UnderReview,
            'user_id' => Auth::id(),
            'model_id' => $validated['model_id'],
            'model_type' => EventProgram::class,
        ]);

        return back();
    }
}
