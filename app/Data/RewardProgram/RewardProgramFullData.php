<?php

namespace App\Data\RewardProgram;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use App\Data\TargetGroup\TargetGroupData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class RewardProgramFullData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $short_description,
        public int $required_score,
        public string $description,
        public ?ImageData $image,
        /** @var CategoryData[] */
        public array $categories,
        /** @var TargetGroupData[] */
        public array $target_groups,
    ) {}
}
