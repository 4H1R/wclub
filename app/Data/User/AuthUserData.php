<?php

namespace App\Data\User;

use Hashids;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AuthUserData extends Data
{
    #[Computed]
    public string $hash_id;

    public function __construct(
        public int $id,
        public string $first_name,
        public string $last_name,
        public int $score,
        public ?string $email,
        public ?string $phone,
        public ?string $email_verified_at,
        public ?string $phone_verified_at,
        public bool $can_access_admin_panel,
        public string $created_at,
        public string $updated_at,
    ) {
        $this->hash_id = Hashids::connection('users')->encode($id);
    }
}
