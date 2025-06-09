<?php

namespace App\Data\Series;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use App\Data\TargetGroup\TargetGroupData;
use App\Enums\PaymentTypeEnum;
use App\Enums\Series\SeriesStatusEnum;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeriesData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public PaymentTypeEnum $payment_type,
        public SeriesStatusEnum $status,
        public ?int $price,
        public ?int $previous_price,
        public string $short_description,
        public int $episodes_duration_seconds,
        public ?ImageData $image,
        /** @var CategoryData[] */
        public array $categories,
        /** @var TargetGroupData[] */
        public array $target_groups,
    ) {}
}
