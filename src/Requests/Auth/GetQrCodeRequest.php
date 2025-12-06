<?php

namespace Zifala\GoWhatsApp\Requests\Auth;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetQrCodeRequest extends Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/user/login/qr';
    }
}

