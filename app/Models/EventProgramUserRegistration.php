<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperEventProgramUserRegistration
 */
class EventProgramUserRegistration extends Model
{
    /** @use HasFactory<\Database\Factories\EventProgramUserRegistrationFactory> */
    use HasFactory;

    public function eventProgram(): BelongsTo
    {
        return $this->belongsTo(EventProgram::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
