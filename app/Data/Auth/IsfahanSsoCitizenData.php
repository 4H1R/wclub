<?php

namespace App\Data\Auth;

use Spatie\LaravelData\Data;

class IsfahanSsoCitizenData extends Data
{
    public function __construct(
        public string $citizenFirstName,
        public string $citizenLastName,
        public string $citizenFatherName,
        public string $citizenNationalCode,
        public bool $citizenGender,
        public string $citizenBirthDate,
        public string $citizenMobile,
        public ?string $citizenMaritalStatusName,
        public ?string $citizenCity,
        public ?string $citizenFullAddress,
        public ?string $citizenMainStreet,
        public ?string $citizenSubStreet,
        public ?string $citizenAlley,
        public ?string $citizenPelak,
        public ?string $citizenPostalCode,
        public string $citizenFullName,
        public ?string $citizenPic,
    ) {}
}
