<?php

namespace App\Models;

use App\Models\Traits\HasCategories;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTargetGroups;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperContest
 */
class Contest extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ContestFactory> */
    use HasCategories, HasFactory, HasSlug, HasTargetGroups, InteractsWithMedia;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    /**
     * @return MorphOne<Media>
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', 'image');
    }

    /**
     * @return BelongsToMany<User>
     */
    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'contest_user_registrations');
    }

    /**
     * @param  Builder<EventProgram>  $query
     */
    public function scopeQuery(Builder $query, string $value): void
    {
        $query->whereAny(['title'], 'ilike', "%$value%");
    }
}
