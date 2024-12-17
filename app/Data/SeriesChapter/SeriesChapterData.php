<?php

namespace App\Data\SeriesChapter;

use App\Data\SeriesEpisode\SeriesEpisodeData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SeriesChapterData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        /** @var SeriesEpisodeData[] */
        public array $episodes = [],
    ) {}
}
