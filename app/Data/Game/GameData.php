<?php

namespace App\Data\Game;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class GameData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $slug,
        public string $short_description,
        public string $image,
        public string $image_type,
    ) {}
}
