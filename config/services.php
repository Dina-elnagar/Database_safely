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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // 'twilio' => [
    //     'account_sid' => env('AC079eae7444a2ea370c595b9b023b7bc4'),
    //     'auth_token' => env('cd7dea0a5a314f9cd8015603ac9a9f97'),
    //     'from' => env('+201113770021'),
    // ], ];
    'Vonage' => [
        'api_key' => env('VONAGE_KEY'),

    'api_secret' => env('VONAGE_SECRET'),

    'sms_from' => env('VONAGE_SMS_FROM'),

    ]


    ];
