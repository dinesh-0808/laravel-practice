<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Dump Destination
    |--------------------------------------------------------------------------
    |
    | This is the default destination where dumps will be sent.
    |
    | Supported: "web", "json", "socket", "console", "file", "laravel-log"
    |
    */

    'default' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Dump Destinations
    |--------------------------------------------------------------------------
    |
    | Here you may configure the dump destinations for your application.
    |
    */

    'destinations' => [

        'web' => [
            'host' => env('DS_APP_URL', 'http://localhost'),
            'port' => env('DS_APP_PORT', 9191),
        ],

        'socket' => [
            'host' => env('DS_SOCKET_HOST', 'localhost'),
            'port' => env('DS_SOCKET_PORT', 9192),
        ],

        'file' => [
            'path' => storage_path('logs/dumps.log'),
        ],

        'console' => [
            'enabled' => env('DS_CONSOLE_ENABLED', true),
        ],

        'json' => [
            'path' => storage_path('logs/dumps.json'),
        ],

        'laravel-log' => [
            'path' => storage_path('logs/laravel.log'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Excluded Paths
    |--------------------------------------------------------------------------
    |
    | Here you may specify any paths that should be excluded from dumps.
    |
    */

    'excluded_paths' => [
        'vendor',
        'storage',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ignored Data
    |--------------------------------------------------------------------------
    |
    | Here you may specify any data that should be ignored when dumping.
    |
    */

    'ignore' => [
        'password',
        'password_confirmation',
    ],

];
