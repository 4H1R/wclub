<?php

namespace App\Models;

use App\Models\Traits\HasCategories;
use App\Models\Traits\HasQuestionForms;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTargetGroups;
use App\Models\Traits\HasTopics;
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
    use HasCategories, HasFactory, HasQuestionForms, HasSlug, HasTargetGroups, HasTopics, InteractsWithMedia;

    protected $casts = [
        'can_upload_image' => 'boolean',
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
     * @return BelongsToMany<User>
     */
    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'contest_user_registrations');
    }

    /**
     * @return MorphOne<QuestionForm>
     */
    public function questionForm(): MorphOne
    {
        return $this->morphOne(QuestionForm::class, 'model');
    }

    /**
     * @param  Builder<EventProgram>  $query
     */
    public function scopeQuery(Builder $query, string $value): void
    {
        $query->whereAny(['title'], 'ilike', "%$value%");
    }

    public static function getCardRelations(): array
    {
        return ['image', 'targetGroups', 'categories'];
    }

    public function canAnswerQuestionForm(): bool
    {
        return $this->started_at <= now() && $this->finished_at >= now();
    }
}
