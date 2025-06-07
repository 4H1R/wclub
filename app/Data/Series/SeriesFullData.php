<?php

namespace App\Data\Series;

use App\Data\Category\CategoryData;
use App\Data\Media\ImageData;
use App\Data\SeriesChapter\SeriesChapterData;
use App\Enums\PaymentTypeEnum;
use App\Enums\Series\SeriesStatusEnum;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeriesFullData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public PaymentTypeEnum $payment_type,
        public SeriesStatusEnum $status,
        public ?int $price,
        public ?int $previous_price,
        public string $short_description,
        public string $description,
        public int $episodes_duration_seconds,
        public int $episodes_count,
        public int $owned_users_count,
        public bool $is_owned,
        /** @var SeriesChapterData[] */
        public array $chapters,
        /** @var SeriesFaqData[] */
        public ?array $faqs_array,
        public ?ImageData $image,
        /** @var CategoryData[] */
        public array $categories,
        public string $published_at,
    ) {}
}
