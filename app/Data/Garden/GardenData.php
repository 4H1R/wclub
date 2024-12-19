<?php

namespace App\Data\Garden;

use App\Data\Media\ImageData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class GardenData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $address,
        public int $max_participants,
        /** @var ImageData[] */
        public array $images,
    ) {}
}
