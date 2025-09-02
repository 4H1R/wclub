<?php

namespace App\Enums\Logger;

use EmreYarligan\EnumConcern\EnumConcern;

enum SiemLogIdEnum: string
{
    use EnumConcern;

    case WrongPassword = '20020';
    case AccountExpired = '20021';
    case AccountLocked = '20022';
    case AccountInactive = '20023';
    case AccountDeleted = '20024';
    case AccountGotLocked = '20030';
    case AccountGotLimited = '20031';
    case AccountCreated = '20032';
    case AccountGroupChanged = '20033';
    case AccountGotDeleted = '20034';
}
