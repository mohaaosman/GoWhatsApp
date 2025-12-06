<?php

namespace Zifala\GoWhatsApp;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use Zifala\GoWhatsApp\Middleware\LogRequestMiddleware;
use Zifala\GoWhatsApp\Resource\App;
use Zifala\GoWhatsApp\Resource\Chat;
use Zifala\GoWhatsApp\Resource\Group;
use Zifala\GoWhatsApp\Resource\Message;
use Zifala\GoWhatsApp\Resource\Newsletter;
use Zifala\GoWhatsApp\Resource\Send;
use Zifala\GoWhatsApp\Resource\User;
use Saloon\Http\Auth\BasicAuthenticator;

class GoWhatsAppConnector extends Connector
{
    use AcceptsJson;

    public function __construct(
        protected ?string $baseUrl = null,
        protected ?string $username = null,
        protected ?string $password = null
    ) {
        $this->baseUrl = $baseUrl ?? config('go-whatsapp.base_url');
        $this->username = $username ?? config('go-whatsapp.username');
        $this->password = $password ?? config('go-whatsapp.password');

        // Register Logging Middleware
        $this->middleware()->onResponse(new LogRequestMiddleware());
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
        return [
            'Content-Type' => 'application/json',
        ];
    }

    protected function defaultAuth(): ?BasicAuthenticator
    {
        if ($this->username && $this->password) {
            return new BasicAuthenticator($this->username, $this->password);
        }
        return null;
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

    public function sending(): Send
    {
        return new Send($this);
    }

    public function user(): User
    {
        return new User($this);
    }
}
