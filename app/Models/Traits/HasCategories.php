<?php

namespace App\Models\Traits;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasCategories
{
    public static function bootHasCategories(): void
    {
        static::deleted(function (mixed $deletedModel) {
            $deletedModel->categories()->delete();
        });
    }

    /**
     * @return MorphToMany<Category>
     */
    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'model', 'category_model')
            ->where('categories.model', self::class);
    }
}
