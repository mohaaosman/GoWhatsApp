<?php

namespace Zifala\GoWhatsApp\Traits;

use Exception;
use ReflectionClass;
use RuntimeException;
use Zifala\GoWhatsApp\GoWhatsAppConnector;
use Zifala\GoWhatsApp\Requests\Message\SendTextRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;

trait HasGoWhatsAppRequest
{
    use HasGoWhatsAppLog;

    /**
     * Send a WhatsApp text message.
     */
    public function sendText(string $phone, string $message, ?string $replyTo = null): bool
    {
        try {
            $connector = new GoWhatsAppConnector();
            $request = new SendTextRequest($phone, $message, $replyTo);
            
            $response = $connector->send($request);

            if ($response->successful()) {
                $data = $response->json('data'); // Assuming API returns 'data' key based on standard practices, verify against actual API response if needed. 
                // Based on openapi.yaml, the success response for /chat/send/text usually returns a JSON with message details.
                // Adjusting to capture relevant response data.
                
                $this->successLog([
                    'phone' => $phone,
                    'message' => $message,
                    'response' => $data,
                    'timestamp' => now()->toIso8601String(),
                ]);

                return true;
            }

            throw new RuntimeException($response->body());

        } catch (FatalRequestException|RequestException|Exception $e) {
            $this->errorLog([
                'error' => (new ReflectionClass($e))->getShortName(),
                'message' => $e->getMessage(),
                'phone' => $phone,
            ]);
        }

        return false;
    }
}

