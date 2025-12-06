<?php

namespace Zifala\GoWhatsApp;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class GoWhatsAppConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return config('go-whatsapp.base_url');
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        if ($apiKey = config('go-whatsapp.api_key')) {
            $headers['Authorization'] = 'Bearer ' . $apiKey;
        }

        return $headers;
    }
}
