<?php

namespace App\Models;

use App\Enums\EventProgram\EventProgramStatusEnum;
use App\Models\Traits\HasCategories;
use App\Models\Traits\HasFaqs;
use App\Models\Traits\HasSlug;
use App\Models\Traits\HasTargetGroups;
use App\Models\Traits\HasTopics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperEventProgram
 */
class EventProgram extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\EventProgramFactory> */
    use HasCategories, HasFactory, HasFaqs, HasSlug, HasTargetGroups, HasTopics, InteractsWithMedia;

    protected $casts = [
        'status' => EventProgramStatusEnum::class,
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
     * @return BelongsTo<User,EventProgram>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany<User>
     */
    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_program_user_registrations')
            ->withTimestamps();
    }

    /**
     * @return HasMany<EventProgramUserRegistration>
     */
    public function rawRegistrations(): HasMany
    {
        return $this->hasMany(EventProgramUserRegistration::class);
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
}
