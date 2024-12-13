<?php

namespace App\Data\TargetGroup;

use App\Data\Media\ImageData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TargetGroupData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?ImageData $image,
    ) {}
}
