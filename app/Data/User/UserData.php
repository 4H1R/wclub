<?php

namespace App\Data\User;

use App\Data\Media\ImageData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class UserData extends Data
{
    public function __construct(
        public int $id,
        public string $first_name,
        public string $last_name,
        public ?ImageData $image,
        public string $created_at,
    ) {}
}
