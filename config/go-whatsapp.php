<?php

return [
    'base_url' => env('GO_WHATSAPP_BASE_URL', 'http://localhost:3000'),
    'username' => env('GO_WHATSAPP_USERNAME', ''),
    'password' => env('GO_WHATSAPP_PASSWORD', ''),
    'logging_enabled' => env('GO_WHATSAPP_LOGGING_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure if the send operations should be queued.
    |
    */
    'queue_enabled' => env('GO_WHATSAPP_QUEUE_ENABLED', false),
    'queue_connection' => env('GO_WHATSAPP_QUEUE_CONNECTION', 'sync'),
    'queue_name' => env('GO_WHATSAPP_QUEUE_NAME', 'default'),
];
