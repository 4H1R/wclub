<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Contest;
use App\Models\Coupon;
use App\Models\EventProgram;
use App\Models\Garden;
use App\Models\News;
use App\Models\RewardProgram;
use App\Models\TargetGroup;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            SeriesSeeder::class,
        ]);

        collect(File::json('database/json/target_groups.json')['entities'])->each(function (array $targetGroup) {
            TargetGroup::firstOrCreate($targetGroup);
        });

        $firstUser = User::firstOrFail();

        ContactUs::factory(30)->create();
        Coupon::factory(30)->create();

        $rewardProgramCategories = Category::factory(10)->create(['model' => RewardProgram::class]);
        RewardProgram::factory(50)
            ->create()
            ->each(function (RewardProgram $rewardProgram) use ($rewardProgramCategories) {
                $rewardProgram->categories()->attach($rewardProgramCategories->random(rand(0, 5))->pluck('id'));
            });

        $eventProgramCategories = Category::factory(10)->create(['model' => EventProgram::class]);
        EventProgram::factory(50)
            ->for($firstUser)
            ->create()
            ->each(function (EventProgram $eventProgram) use ($eventProgramCategories) {
                $eventProgram->categories()->attach($eventProgramCategories->random(rand(0, 5))->pluck('id'));
            });

        $contestsCategories = Category::factory(10)->create(['model' => Contest::class]);
        Contest::factory(50)
            ->create()
            ->each(function (Contest $contest) use ($contestsCategories) {
                $contest->categories()->attach($contestsCategories->random(rand(0, 5))->pluck('id'));
            });

        $newsCategories = Category::factory(10)->create(['model' => News::class]);
        News::factory(50)
            ->create()
            ->each(function (News $news) use ($newsCategories) {
                $news->categories()->attach($newsCategories->random(rand(0, 5))->pluck('id'));
            });

        Garden::factory(50)->create();
    }
}
