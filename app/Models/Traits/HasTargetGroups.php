<?php

namespace App\Models\Traits;

use App\Models\Tag;
use App\Models\TargetGroup;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTargetGroups
{
    public static function bootHasTargetGroups(): void
    {
        static::deleted(function (mixed $deletedModel) {
            $deletedModel->targetGroups()->delete();
        });
    }

    /**
     * @return MorphToMany<Tag>
     */
    public function targetGroups(): MorphToMany
    {
        return $this->morphToMany(TargetGroup::class, 'model', 'target_group_model');
    }
}
