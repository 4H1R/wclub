<?php

namespace App\Data\EventProgram;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use App\Data\TargetGroup\TargetGroupData;
use App\Enums\PaymentTypeEnum;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class EventProgramFullData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $short_description,
        public string $description,
        public PaymentTypeEnum $payment_type,
        public ?int $price,
        public ?int $previous_price,
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
