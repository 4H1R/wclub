<?php

namespace App\Data\Tag;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TagData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
    ) {}
}
