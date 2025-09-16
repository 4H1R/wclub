<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<Category,Category>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    /**
     * @return BelongsTo<Category,Category>
     */
    public function parentSelect(): BelongsTo
    {
        return $this->parent()->whereNull('parent_id');
    }

    /**
     * @return HasMany<Category>
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }
}
