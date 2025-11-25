<?php

namespace App\Data\QuestionForm;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class QuestionFormPropertiesData extends Data
{
    public function __construct(
        /** @var QuestionFormPropertiesOptionData[] */
        public array $options = [],
    ) {}
}
