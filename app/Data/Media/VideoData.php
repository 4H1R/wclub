<?php

namespace App\Data\Media;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class VideoData extends Data
{
    public function __construct(
        public int $id,
        public string $mime_type,
        public ?string $original_url,
    ) {}
}
