<?php

namespace App\Data\Faq;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class FaqData extends Data
{
    public function __construct(
        public int $id,
        public string $question,
        public ?string $answer,
        public string $created_at,
    ) {}
}
