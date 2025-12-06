<?php

namespace Zifala\GoWhatsApp\Traits;

use Exception;
use ReflectionClass;
use RuntimeException;
use Zifala\GoWhatsApp\GoWhatsAppConnector;
use Zifala\GoWhatsApp\Requests\Send\SendMessage;
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
            $request = new SendMessage();
            
            $payload = [
                'phone' => $phone,
                'message' => $message,
            ];

             if ($replyTo) {
                $payload['reply_message_id'] = $replyTo;
            }

            $request->body()->set($payload);
            
            $response = $connector->send($request);

            if ($response->successful()) {
                $data = $response->json('results');
                
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
