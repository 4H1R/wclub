<?php

namespace App\Data\QuestionForm;

use App\Models\QuestionForm;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class QuestionFormFullData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        /** @var QuestionFormQuestionData[] */
        public array $questions = [],
    ) {}

    public static function fromModel(QuestionForm $questionForm): self
    {
        return self::from([
            ...$questionForm->toArray(),
            'questions' => QuestionFormQuestionData::collect($questionForm->questions),
        ]);
    }
}
