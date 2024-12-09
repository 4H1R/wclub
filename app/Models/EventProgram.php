<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEventProgram
 */
class EventProgram extends Model
{
    /** @use HasFactory<\Database\Factories\EventProgramFactory> */
    use HasFactory;
}
