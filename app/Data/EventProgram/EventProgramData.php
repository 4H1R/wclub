<?php

namespace App\Data\EventProgram;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use App\Data\TargetGroup\TargetGroupData;
use App\Enums\EventProgram\EventProgramStatusEnum;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class EventProgramData extends Data
{
    public function __construct(
        public int $id,
        public EventProgramStatusEnum $status,
        public string $title,
        public string $short_description,
        public ?ImageData $image,
        public ?int $min_participants,
        public ?int $max_participants,
        public string $started_at,
        public string $finished_at,
        /** @var CategoryData[] */
        public array $categories,
        /** @var TargetGroupData[] */
        public array $target_groups,
    ) {}
}
