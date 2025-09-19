<?php

namespace App\Data\Topic;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TopicData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        /** @var TopicData[] */
        public array $children = [],
    ) {}
}
