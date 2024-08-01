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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'payu' => [
        'base_uri' => env('PAYU_BASE_URI'),
        'key' => env('PAYU_KEY'),
        'secret' => env('PAYU_SECRET'),
        'base_currency' => env('PAYU_BASE_CURRENCY', 'COP'),
        'merchant_id' => env('PAYU_BASE_MERCHANT_ID'),
        'account_id' => env('PAYU_BASE_ACCOUNT_ID'),
        'class' => App\Services\PayUService::class,
    ],

];
