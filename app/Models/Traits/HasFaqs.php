<?php

namespace App\Models\Traits;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasFaqs
{
    public static function bootHasFaqs(): void
    {
        static::deleted(function (mixed $deletedModel) {
            $deletedModel->faqs()->delete();
        });
    }

    /**
     * @return MorphToMany<Faq>
     */
    public function faqs(): MorphMany
    {
        return $this->morphMany(Faq::class, 'model');
    }
}
