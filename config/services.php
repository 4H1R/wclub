<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'sms' => [
        'username' => env('SMS_USERNAME'),
        'password' => env('SMS_PASSWORD'),
        'phone' => env('SMS_PHONE'),
    ],

    'mellat' => [
        'username' => env('MELLAT_USERNAME'),
        'password' => env('MELLAT_PASSWORD'),
        'terminal_id' => env('MELLAT_TERMINAL_ID'),
        'wsdl_url' => env('MELLAT_WSDL_URL', 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl'),
    ],

    'isfahan_sso' => [
        'client_id' => env('ISFAHAN_SSO_CLIENT_ID'),
        'secret' => env('ISFAHAN_SSO_SECRET'),
    ],

    'hcaptcha' => [
        'site_key' => env('HCAPTCHA_SITE_KEY'),
        'secret_key' => env('HCAPTCHA_SECRET_KEY'),
    ],
];
