<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperHnText
 */
class HnText extends Model
{
    /** @use HasFactory<\Database\Factories\HnTextFactory> */
    use HasFactory;

    /**
     * @param  Builder<HnText>  $query
     */
    public function scopeQuery(Builder $query, string $value): void
    {
        $query->whereAny(['text', 'author'], 'ilike', "%$value%");
    }
}
