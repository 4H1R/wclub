<?php

namespace App\Data\Auth;

use App\Enums\GenderEnum;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class IsfahanSsoCitizenData extends Data
{
    #[Computed]
    public GenderEnum $citizenGenderEnum;

    public function __construct(
        public string $citizenFirstName,
        public string $citizenLastName,
        public string $citizenFatherName,
        public string $citizenNationalCode,
        public string $citizenGender,
        public string $citizenBirthDate,
        public string $citizenMobile,
        public string $fullAddress,
    ) {
        $this->citizenGenderEnum = match ($this->citizenGender) {
            'مرد' => GenderEnum::Male,
            'زن' => GenderEnum::Female,
            default => throw new \Exception('Invalid gender'),
        };
    }
}
