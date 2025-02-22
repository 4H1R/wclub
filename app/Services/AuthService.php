<?php

namespace App\Services;

use Random\RandomException;

class AuthService
{
    public function __construct(private readonly AppService $appService) {}

    public const phoneRegex = '/^[0][9][0-9]{9,9}$/';

    /**
     * @throws RandomException
     */
    public function generateNumericToken(): int
    {
        // Todo: Remove for real production
        return 5623;

        return $this->appService->isLocalStrict() ? 1234 : random_int(1111, 9999);
    }
}
