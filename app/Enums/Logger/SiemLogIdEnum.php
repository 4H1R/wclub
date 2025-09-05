<?php

namespace App\Enums\Logger;

use EmreYarligan\EnumConcern\EnumConcern;

enum SiemLogIdEnum: string
{
    use EnumConcern;

    case UserLoggedIn = '2001';
    case AuthFailedWrongPassword = '2002';
    case AuthFailedSessionExpired = '2003';
    case AuthFailedSessionIsRateLimited = '2004';
    case UserGotDeleted = '2005';
    case UserGotCreated = '2006';
    case UserLoggedOut = '3001';
    case RoleGotUpdated = '4001';
    case RoleGotCreated = '4002';
    case RoleGotDeleted = '4003';
    case UserRoleGotUpdated = '4004';
    case UserDoesNotHavePermission = '4005';
}
