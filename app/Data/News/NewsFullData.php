<?php

namespace App\Data\News;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use App\Data\Media\VideoData;
use App\Data\TargetGroup\TargetGroupData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NewsFullData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $short_description,
        public string $description,
        public ?ImageData $image,
        public ?VideoData $video,
        /** @var CategoryData[] */
        public array $categories,
        /** @var TargetGroupData[] */
        public array $target_groups,
    ) {}
}
