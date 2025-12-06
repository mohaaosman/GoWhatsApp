<?php

namespace Zifala\GoWhatsApp\Requests\Message;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Contracts\Body\HasBody;

class SendTextRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $phone,
        protected string $message,
        protected ?string $replyTo = null
    ) {}

    public function resolveEndpoint(): string
    {
        return '/chat/send/text';
    }

    protected function defaultBody(): array
    {
        $body = [
            'phone' => $this->phone,
            'message' => $this->message,
        ];

        if ($this->replyTo) {
            $body['reply_to'] = $this->replyTo;
        }

        return $body;
    }
}

