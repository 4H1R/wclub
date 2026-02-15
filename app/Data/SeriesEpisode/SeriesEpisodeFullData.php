<?php

namespace App\Data\SeriesEpisode;

use App\Data\Media\VideoData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeriesEpisodeFullData extends Data
{
    public function __construct(
        public int $id,
        public int $episode_number,
        public int $chapter_id,
        public string $title,
        public ?string $description,
        public int $video_duration_seconds,
        public ?VideoData $video,
        public ?string $aparat_video_hash,
        public string $created_at,
    ) {}
}
