<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\RewardProgram;
use App\Models\TargetGroup;
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
        ]);

        collect(File::json('database/json/target_groups.json')['entities'])->each(function (array $targetGroup) {
            TargetGroup::firstOrCreate($targetGroup);
        });

        $rewardProgramCategories = Category::factory(10)->create(['model' => RewardProgram::class]);
        RewardProgram::factory(50)
            ->create()
            ->each(function (RewardProgram $rewardProgram) use ($rewardProgramCategories) {
                $rewardProgram->categories()->attach($rewardProgramCategories->random(rand(0, 5))->pluck('id'));
            });
    }
}
