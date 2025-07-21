<?php

use Telegram\Bot\Commands\HelpCommand;

return [

    /*
    |--------------------------------------------------------------------------
    | Telegram Bots
    |--------------------------------------------------------------------------
    |
    | You may use multiple bots at once using the manager class. Each bot
    | should be configured here with a token and optional settings.
    |
    */
    'bots' => [

        'mybot' => [
            'token' => env('TELEGRAM_BOT_TOKEN', 'YOUR-BOT-TOKEN'),
            'certificate_path' => env('TELEGRAM_CERTIFICATE_PATH', null),
            'webhook_url' => env('TELEGRAM_WEBHOOK_URL', null),
            'allowed_updates' => null,
            'commands' => [
                // Example:
                // App\Telegram\Commands\StartCommand::class,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Bot Name
    |--------------------------------------------------------------------------
    |
    | The default bot that will be used if no specific bot is selected.
    |
    */
    'default' => 'mybot',

    /*
    |--------------------------------------------------------------------------
    | Asynchronous Requests
    |--------------------------------------------------------------------------
    |
    | Set to true if you want to make all requests non-blocking (async).
    |
    */
    'async_requests' => env('TELEGRAM_ASYNC_REQUESTS', false),

    /*
    |--------------------------------------------------------------------------
    | HTTP Client Handler
    |--------------------------------------------------------------------------
    |
    | If you want to use a custom HTTP client, set it here.
    |
    */
    'http_client_handler' => null,

    /*
    |--------------------------------------------------------------------------
    | Base Bot URL
    |--------------------------------------------------------------------------
    |
    | If you want to use a custom base URL for Telegram API (proxy/local).
    |
    */
    'base_bot_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Resolve Command Dependencies
    |--------------------------------------------------------------------------
    |
    | Allow Laravel IoC container to auto-resolve command dependencies.
    |
    */
    'resolve_command_dependencies' => true,

    /*
    |--------------------------------------------------------------------------
    | Global Commands
    |--------------------------------------------------------------------------
    |
    | These commands will be available to all bots by default.
    |
    */
    'commands' => [
        HelpCommand::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Command Groups
    |--------------------------------------------------------------------------
    |
    | You can organize commands into groups for easier management.
    |
    */
    'command_groups' => [
        // Example:
        // 'admin' => [
        //     App\Telegram\Commands\AdminStatsCommand::class,
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Shared Commands
    |--------------------------------------------------------------------------
    |
    | Shared commands can be used across multiple bots or groups.
    |
    */
    'shared_commands' => [
        // Example:
        // 'start' => App\Telegram\Commands\StartCommand::class,
    ],

];
