<?php

namespace App\Models\Traits;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTopics
{
    public static function bootHasTopics(): void
    {
        static::deleted(function (mixed $deletedModel) {
            $deletedModel->topics()->detach();
        });
    }

    /**
     * @return MorphToMany<Topic>
     */
    public function topics(): MorphToMany
    {
        return $this->morphToMany(Topic::class, 'model', 'topic_model');
    }
}
