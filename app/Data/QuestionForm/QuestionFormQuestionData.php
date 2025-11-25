<?php

namespace App\Data\QuestionForm;

use App\Enums\QuestionForm\QuestionFormTypeEnum;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class QuestionFormQuestionData extends Data
{
    public function __construct(
        public string $id,
        public string $title,
        public QuestionFormTypeEnum $type,
        public ?string $description,
        public QuestionFormPropertiesData $properties,
    ) {}
}
