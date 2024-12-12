<?php

namespace App\Data\ContactUs;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class RequestContactUsData extends Data
{
    public function __construct(
        #[Min(3), Max(255)]
        public string $full_name,
        #[Min(3), Max(255), Email]
        public ?string $email,
        #[Min(11), Max(14)]
        public string $phone,
        #[Min(3), Max(255)]
        public string $title,
        #[Min(3), Max(1024)]
        public string $description,
    ) {}
}
