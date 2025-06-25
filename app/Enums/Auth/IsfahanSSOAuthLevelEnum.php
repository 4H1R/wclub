<?php

namespace App\Enums\Auth;

enum IsfahanSSOAuthLevelEnum: string
{
    const Mobile = '1';

    const WithoutAuthorization = '2';

    const AuthorizedMobileAndNationalCode = '3';
}
