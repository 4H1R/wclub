<?php

namespace App\Data\Auth;

use Spatie\LaravelData\Data;

class IsfahanSsoCitizenData extends Data
{
    public function __construct(
        public string $CitizenFirstName,
        public string $CitizenLastName,
        public string $CitizenFatherName,
        public string $CitizenNationalCode,
        public bool $CitizenGender,
        public string $CitizenBirthDate,
        public string $CitizenMobile,
        public ?string $CitizenMaritalStatusName,
        public ?string $CitizenCity,
        public ?string $CitizenFullAddress,
        public ?string $CitizenMainStreet,
        public ?string $CitizenSubStreet,
        public ?string $CitizenAlley,
        public ?string $CitizenPelak,
        public ?string $CitizenPostalCode,
        public string $CitizenFullName,
        public ?string $CitizenPic,
    ) {}
}
