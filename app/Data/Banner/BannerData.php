<?php

namespace App\Data\Banner;

use App\Data\Media\ImageData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BannerData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $link,
        public ?ImageData $image,
    ) {}
}
