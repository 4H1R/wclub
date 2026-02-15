<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Contest;
use App\Models\Coupon;
use App\Models\EventProgram;
use App\Models\Faq;
use App\Models\Garden;
use App\Models\HnImage;
use App\Models\HnText;
use App\Models\News;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RewardProgram;
use App\Models\Series;
use App\Models\TargetGroup;
use App\Models\Topic;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        collect(File::json('database/json/target_groups.json')['entities'])->each(function (array $targetGroup) {
            TargetGroup::firstOrCreate($targetGroup);
        });

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            SeriesSeeder::class,
        ]);

        $firstUser = User::firstOrFail();

        ContactUs::factory(30)->create();
        Coupon::factory(30)->create();
        Topic::factory(10)->create();

        $rewardProgramCategories = Category::factory(10)->create(['model' => RewardProgram::class]);
        RewardProgram::factory(50)
            ->create()
            ->each(function (RewardProgram $rewardProgram) use ($rewardProgramCategories) {
                $rewardProgram->categories()->attach($rewardProgramCategories->random(rand(0, 5))->pluck('id'));
                $rewardProgram->targetGroups()->attach(TargetGroup::all()->random(rand(1, 3))->pluck('id'));
            });

        $eventProgramCategories = Category::factory(10)->create(['model' => EventProgram::class]);
        EventProgram::factory(50)
            ->for($firstUser)
            ->create()
            ->each(function (EventProgram $eventProgram) use ($eventProgramCategories) {
                $eventProgram->categories()->attach($eventProgramCategories->random(rand(0, 5))->pluck('id'));
                $eventProgram->targetGroups()->attach(TargetGroup::all()->random(rand(1, 3))->pluck('id'));
                Faq::factory(random_int(0, 5))->for($eventProgram, 'model')->create();
            });

        $contestsCategories = Category::factory(10)->create(['model' => Contest::class]);
        Contest::factory(50)
            ->create()
            ->each(function (Contest $contest) use ($contestsCategories) {
                $contest->categories()->attach($contestsCategories->random(rand(0, 5))->pluck('id'));
                $contest->targetGroups()->attach(TargetGroup::all()->random(rand(1, 3))->pluck('id'));
            });

        $newsCategories = Category::factory(10)->create(['model' => News::class]);
        News::factory(50)
            ->create()
            ->each(function (News $news) use ($newsCategories) {
                $news->categories()->attach($newsCategories->random(rand(0, 5))->pluck('id'));
                $news->targetGroups()->attach(TargetGroup::all()->random(rand(1, 3))->pluck('id'));
            });

        Garden::factory(50)->create();

        $users = User::pluck('id');
        $series = Series::pluck('id');
        Order::factory(20)->sequence(fn () => ['user_id' => $users->random()])
            ->create()
            ->each(function (Order $order) use ($series) {
                $series->random(random_int(1, 5))
                    ->each(function ($series_id) use ($order) {
                        OrderItem::factory(random_int(1, 5))->create([
                            'order_id' => $order->id,
                            'model_type' => Series::class,
                            'model_id' => $series_id,
                        ]);
                    });
                Transaction::factory(random_int(1, 5))->create([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                ]);
            });

        HnText::factory(50)->create();
        HnImage::factory(50)->create();
    }
}
