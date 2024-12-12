<?php

namespace App\Data\User;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AuthUserData extends Data
{
    public function __construct(
        public int $id,
        public string $first_name,
        public string $last_name,
        public ?string $email,
        public ?string $phone,
        public ?string $email_verified_at,
        public ?string $phone_verified_at,
        public bool $can_access_admin_panel,
        public string $created_at,
        public string $updated_at,
    ) {}
}
