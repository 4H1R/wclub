<?php

namespace App\Models;

use App\Models\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @mixin IdeHelperSeriesChapter
 */
class SeriesChapter extends Model implements Sortable
{
    /** @use HasFactory<\Database\Factories\SeriesChapterFactory> */
    use HasFactory, HasSlug, SortableTrait;

    /**
     * @return HasMany<SeriesEpisode>
     */
    public function episodes(): HasMany
    {
        return $this->hasMany(SeriesEpisode::class, 'chapter_id');
    }

    /**
     * @return BelongsTo<Series,SeriesChapter>
     */
    public function series(): BelongsTo
    {
        return $this->belongsTo(Series::class);
    }
}
