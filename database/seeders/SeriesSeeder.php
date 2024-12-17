<?php

namespace Database\Seeders;

use App\Models\Series;
use App\Models\SeriesChapter;
use App\Models\SeriesEpisode;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    public function run(): void
    {
        Series::factory(20)
            ->create()
            ->each(function (Series $series) {
                SeriesChapter::factory(rand(3, 10))->for($series)->create()
                    ->each(function (SeriesChapter $chapter) use ($series) {
                        SeriesEpisode::factory(rand(3, 10))
                            ->for($chapter, 'chapter')
                            ->for($series)
                            ->createQuietly();
                    });
            });
    }
}
