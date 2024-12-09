<?php

namespace App\Models;

use App\Models\Traits\HasCategories;
use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperRewardProgram
 */
class RewardProgram extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\RewardProgramFactory> */
    use HasCategories, HasFactory, HasSlug, InteractsWithMedia;

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
     * @param  Builder<RewardProgram>  $query
     */
    public function scopeQuery(Builder $query, string $value): void
    {
        $query->whereAny(['title'], 'ilike', "%$value%");
    }
}
