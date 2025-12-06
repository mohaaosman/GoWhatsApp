<?php

namespace Zifala\GoWhatsApp\Requests\Auth;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Contracts\Body\HasBody;

class LoginWithCodeRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $phone
    ) {}

    public function resolveEndpoint(): string
    {
        return '/user/login/with-code';
    }

    protected function defaultBody(): array
    {
        return [
            'phone' => $this->phone,
        ];
    }
}

