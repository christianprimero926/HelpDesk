<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
    'client_id' => '1036917301485-9pcgcun1ojdn7418b1mf2m8jl0fe02ih.apps.googleusercontent.com',         // Your google Client ID
    'client_secret' => 'RemPQWAwzkAT2KalT2xVenHG', // Your google Client Secret
    'redirect' => 'http://localhost:8000/auth/google/callback',
    ],

    'facebook' => [
    'client_id' => '1997585463604501',         // Your facebook Client ID
    'client_secret' => '2823db7050416cc46b7e2afe6d459cb0', // Your facebook Client Secret
    'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

];
