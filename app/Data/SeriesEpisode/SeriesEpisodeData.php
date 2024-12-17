<?php

namespace App\Data\SeriesEpisode;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeriesEpisodeData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public int $video_duration_seconds,
    ) {}
}
