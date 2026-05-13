<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Your Telegram Bots
    |--------------------------------------------------------------------------
    |
    | Here you may specify which bots you want to use.
    | You can use multiple bots at once if you wish.
    |
    */

    'bots' => [
        'mybot' => [
            'token' => env('TELEGRAM_BOT_TOKEN', 'YOUR-BOT-TOKEN'),
            'certificate_path' => env('TELEGRAM_CERTIFICATE_PATH', ''),
            'webhook_url' => env('TELEGRAM_WEBHOOK_URL', ''),
            'commands' => [
                //Telegram\Bot\Commands\HelpCommand::class,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Bot Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the bots you want to use by default.
    |
    */

    'default' => 'mybot',

    /*
    |--------------------------------------------------------------------------
    | Asynchronous Requests
    |--------------------------------------------------------------------------
    |
    | When set to True, the SDK will make asynchronous requests.
    |
    */

    'async_requests' => env('TELEGRAM_ASYNC_REQUESTS', false),

    /*
    |--------------------------------------------------------------------------
    | HTTP Client Handler
    |--------------------------------------------------------------------------
    |
    | Here you may specify which HTTP Client Handler you want to use.
    | By default, the SDK uses Guzzle.
    |
    */

    'http_client_handler' => null,

    /*
    |--------------------------------------------------------------------------
    | Base Bot URL
    |--------------------------------------------------------------------------
    |
    | Here you may specify the base bot URL.
    |
    */

    'base_bot_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Resolve Command Dependencies
    |--------------------------------------------------------------------------
    |
    | When set to True, the SDK will resolve command dependencies.
    |
    */

    'resolve_command_dependencies' => true,

    /*
    |--------------------------------------------------------------------------
    | Registered Commands
    |--------------------------------------------------------------------------
    |
    | Here you may specify which commands you want to use.
    |
    */

    'commands' => [
        Telegram\Bot\Commands\HelpCommand::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Command Groups
    |--------------------------------------------------------------------------
    |
    | Here you may specify command groups.
    |
    */

    'command_groups' => [],

    /*
    |--------------------------------------------------------------------------
    | Shared Commands
    |--------------------------------------------------------------------------
    |
    | Here you may specify shared commands.
    |
    */

    'shared_commands' => [],
];
