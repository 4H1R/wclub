<?php

namespace App\Data\Series;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use App\Enums\Series\SeriesStatusEnum;
use App\Enums\Series\SeriesTypeEnum;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeriesData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public SeriesTypeEnum $type,
        public SeriesStatusEnum $status,
        public string $short_description,
        public int $episodes_duration_seconds,
        public ?ImageData $image,
        /** @var CategoryData[] */
        public array $categories,
    ) {}
}
