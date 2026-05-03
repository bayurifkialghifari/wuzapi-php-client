<?php

return [
    /*
    |--------------------------------------------------------------------------
    | WuzAPI Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL of your WuzAPI server instance.
    | Example: http://localhost:8080
    |
    */
    'base_url' => env('WUZAPI_BASE_URL', 'http://localhost:8080'),

    /*
    |--------------------------------------------------------------------------
    | WuzAPI Token
    |--------------------------------------------------------------------------
    |
    | The authentication token for your WuzAPI user session.
    | This can be overridden per-request when using the client directly.
    |
    */
    'token' => env('WUZAPI_TOKEN'),
];
