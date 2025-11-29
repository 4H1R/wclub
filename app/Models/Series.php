<?php

namespace App\Models;

use App\Enums\PaymentTypeEnum;
use App\Enums\Series\SeriesPresentationModeEnum;
use App\Enums\Series\SeriesStatusEnum;
use App\Models\Traits\HasCategories;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTargetGroups;
use App\Models\Traits\HasTopics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperSeries
 */
class Series extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\SeriesFactory> */
    use HasCategories, HasFactory, HasSlug, HasTargetGroups, HasTopics, InteractsWithMedia;

    protected $casts = [
        'status' => SeriesStatusEnum::class,
        'payment_type' => PaymentTypeEnum::class,
        'presentation_mode' => SeriesPresentationModeEnum::class,
        'faqs_array' => 'array',
    ];

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
     * @return HasMany<SeriesChapter>
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(SeriesChapter::class);
    }

    /**
     * @return HasMany<SeriesEpisode>
     */
    public function episodes(): HasMany
    {
        return $this->hasMany(SeriesEpisode::class);
    }

    /**
     * @return HasMany<User>
     */
    public function ownedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_owned_series')
            ->withTimestamps();
    }

    /**
     * @param  Builder<Series>  $query
     */
    public function scopeQuery(Builder $query, string $value): void
    {
        $query->whereAny(['title'], 'ilike', "%$value%");
    }

    public static function getCardRelations(): array
    {
        return ['image', 'targetGroups', 'categories'];
    }
}
