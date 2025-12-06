<?php

namespace Zifala\GoWhatsApp\Middleware;

use Saloon\Contracts\ResponseMiddleware;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Traits\HasGoWhatsAppLog;

class LogRequestMiddleware implements ResponseMiddleware
{
    use HasGoWhatsAppLog;

    public function __invoke(Response $response): void
    {
        // Define payload
        $payload = [
            'method' => $response->getPendingRequest()->getMethod()->name,
            'url' => $response->getPendingRequest()->getUrl(),
            'status' => $response->status(),
            'response_body' => $response->body(),
        ];

        if ($response->successful()) {
            $this->successLog($payload);
        } else {
            $this->errorLog($payload);
        }
    }
}
