<?php

return [
    'api_url' => env('WHATSAPP_API_URL', 'http://localhost:3001'),
    'webhook_base_url' => env('WHATSAPP_WEBHOOK_BASE_URL'),
    'api_timeout' => env('WHATSAPP_API_TIMEOUT', 30),
];
