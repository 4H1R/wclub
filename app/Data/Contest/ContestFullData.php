<?php

namespace App\Data\Contest;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ContestFullData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $short_description,
        public string $description,
        public ?ImageData $image,
        public ?int $min_participants,
        public ?int $max_participants,
        public bool $has_registered,
        public string $started_at,
        public string $finished_at,
        /** @var CategoryData[] */
        public array $categories,
    ) {}
}
