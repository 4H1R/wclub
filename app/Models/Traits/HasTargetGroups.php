<?php

namespace App\Models\Traits;

use App\Models\Tag;
use App\Models\TargetGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTargetGroups
{
    public static function bootHasTargetGroups(): void
    {
        static::deleted(function (mixed $deletedModel) {
            $deletedModel->targetGroups()->detach();
        });

        static::addGlobalScope('session_target_group', function (Builder $builder) {
            if (! request()->hasSession()) {
                return;
            }
            if ($id = request()->session()->get('active_target_group_id')) {
                $builder->whereHas('targetGroups', function (Builder $builder) use ($id) {
                    $builder->where('target_groups.id', $id);
                });
            }
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
