<?php

namespace App\Data\Hn;

use App\Data\Media\ImageData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class HnImageData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ImageData $image,
    ) {}
}
