<?php

namespace App\Models;

use App\Models\Traits\HasCategories;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTargetGroups;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperNews
 */
class News extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\NewsFactory> */
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
     * @param  Builder<News>  $query
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
