<?php

namespace App\Data\EventProgram;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class EventProgramFullData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $short_description,
        public string $content,
        public ?ImageData $image,
        public ?int $min_participants,
        public string $started_at,
        public string $finished_at,
        /** @var CategoryData[] */
        public array $categories,
    ) {}
}
