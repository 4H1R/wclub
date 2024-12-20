<?php

namespace App\Providers;

use App\Custom\FileSystem;
use App\Models\Series;
use App\Models\SeriesChapter;
use App\Models\SeriesEpisode;
use App\Models\User;
use App\Observers\SeriesChapterObserver;
use App\Observers\SeriesEpisodeObserver;
use App\Observers\SeriesObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        \Spatie\MediaLibrary\MediaCollections\Filesystem::class => FileSystem::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::unguard();
        Model::shouldBeStrict(! app()->isProduction());
        JsonResource::withoutWrapping();
        Vite::prefetch(concurrency: 3);
        // DB::prohibitDestructiveCommands(app()->isProduction());
        if (! app()->isProduction()) {
            Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
                $class = get_class($model);

                info("Attempted to lazy load [$relation] on model [$class].");
            });
        }

        Series::observe(SeriesObserver::class);
        SeriesEpisode::observe(SeriesEpisodeObserver::class);
        SeriesChapter::observe(SeriesChapterObserver::class);

        Password::defaults(function () {
            $rule = Password::min(8)->max(28);

            if (! app()->isProduction()) {
                return $rule;
            }

            return $rule->letters()
                ->mixedCase()
                ->numbers()
                ->symbols();
        });

        Gate::define('viewLogViewer', static function (?User $user) {
            return app()->isLocal() || $user?->isSuperAdmin();
        });
    }
}
