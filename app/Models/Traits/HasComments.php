<?php

namespace App\Models\Traits;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasComments
{
    public static function bootHasComments(): void
    {
        static::deleted(function (mixed $deletedModel) {
            $deletedModel->comments()->delete();
        });
    }

    /**
     * @return MorphToMany<Comment>
     */
    public function comments(): MorphToMany
    {
        return $this->morphToMany(Comment::class, 'model', 'comment_model')
            ->where('comments.model', self::class);
    }
}
