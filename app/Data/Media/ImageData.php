<?php

namespace App\Data\Media;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ImageData extends Data
{
    public function __construct(
        public int $id,
        public string $original_url,
    ) {}
}
