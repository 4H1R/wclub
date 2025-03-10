<?php

namespace App\Data\Honeypot;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class HoneypotData extends Data
{
    public function __construct(
        public string $name_field_name,
        public string $valid_from_field_name,
        public string $encrypted_valid_from,
        public bool $enabled,
    ) {}

    public static function fromHoneypot(): self
    {
        $honeypot = app(\Spatie\Honeypot\Honeypot::class);

        return new self(
            name_field_name: $honeypot->nameFieldName(),
            valid_from_field_name: $honeypot->validFromFieldName(),
            encrypted_valid_from: $honeypot->encryptedValidFrom(),
            enabled: $honeypot->enabled()
        );
    }
}
