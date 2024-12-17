<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperSeriesEpisode
 */
class SeriesEpisode extends Model implements HasMedia, Sortable
{
    /** @use HasFactory<\Database\Factories\SeriesEpisodeFactory> */
    use HasFactory, InteractsWithMedia, SortableTrait;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('video')->singleFile();
        $this->addMediaCollection('attachments');
    }

    /**
     * @return MorphOne<Media>
     */
    public function video(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', 'video');
    }

    /**
     * @return MorphMany<Media>
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')
            ->where('collection_name', 'attachments');
    }

    /**
     * @return BelongsTo<SeriesChapter,SeriesEpisode>
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(SeriesChapter::class);
    }

    /**
     * @return BelongsTo<Series,SeriesEpisode>
     */
    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }
}
