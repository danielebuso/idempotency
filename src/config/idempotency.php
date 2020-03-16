<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Idempotency Key name used in request
    |--------------------------------------------------------------------------
    |
    | The key name specified in request headers to look for
    |
    */
    'key' => env('IDEMPOTENCY_KEY', 'Idempotency-Key'),

    /*
    |--------------------------------------------------------------------------
    | Idempotency time to live
    |--------------------------------------------------------------------------
    |
    | Specify the time (in minutes) that the request will be cached for.
    | Defaults to 1 hour.
    |
    */
    'ttl' => env('IDEMPOTENCY_TTL', 60),

    /*
    |--------------------------------------------------------------------------
    | Idempotency request methods
    |--------------------------------------------------------------------------
    |
    | Specify the methods to be cached when an idempotency key is found.
    |
    | Note: According to HTTP semantics, the PUT and DELETE verbs are by
    | design idempotent
    |
    */
    'IDEMPOTENT_METHODS' => [
        'POST',
    ],

];