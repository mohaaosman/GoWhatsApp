<?php

namespace Zifala\GoWhatsApp;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Zifala\GoWhatsApp\Resource\App;
use Zifala\GoWhatsApp\Resource\Chat;
use Zifala\GoWhatsApp\Resource\Group;
use Zifala\GoWhatsApp\Resource\Message;
use Zifala\GoWhatsApp\Resource\Newsletter;
use Zifala\GoWhatsApp\Resource\Send;
use Zifala\GoWhatsApp\Resource\User;

class GoWhatsAppConnector extends Connector
{
    use AcceptsJson;

    public function __construct(
        protected ?string $baseUrl = null,
        protected ?string $apiKey = null
    ) {
        $this->baseUrl = $baseUrl ?? config('go-whatsapp.base_url');
        $this->apiKey = $apiKey ?? config('go-whatsapp.api_key');
    }

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        if ($this->apiKey) {
            $headers['Authorization'] = 'Bearer ' . $this->apiKey;
        }

        return $headers;
    }

    public function app(): App
    {
        return new App($this);
    }

    public function chat(): Chat
    {
        return new Chat($this);
    }

    public function group(): Group
    {
        return new Group($this);
    }

    public function message(): Message
    {
        return new Message($this);
    }

    public function newsletter(): Newsletter
    {
        return new Newsletter($this);
    }

    public function send(): Send
    {
        return new Send($this);
    }

    public function user(): User
    {
        return new User($this);
    }
}
