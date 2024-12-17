<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperContactUs
 */
class ContactUs extends Model
{
    use HasFactory;

    /**
     * @return Attribute<string,string>
     */
    protected function isRead(): Attribute
    {
        return Attribute::make(
            get: fn (null $value, array $attributes) => $attributes['created_at'] !== $attributes['updated_at'],
        );
    }
}
