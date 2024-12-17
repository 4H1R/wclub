<?php

namespace App\Data\Series;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeriesFaqData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
    ) {}
}
