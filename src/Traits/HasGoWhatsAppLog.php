<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Models\GoWhatsAppLog;
use Illuminate\Support\Facades\Log;
use JsonException;

trait HasGoWhatsAppLog
{
    public const WAHA_SUCCESS = 'MESSAGE SUCCESSFULLY SENT';
    public const WAHA_ERROR = 'MESSAGE ERROR';

    /**
     * Create an error log entry.
     */
    public function errorLog(mixed $payload): void
    {
        $this->createLog($payload, self::WAHA_ERROR);
    }

    /**
     * Create a success log entry.
     */
    public function successLog(mixed $payload): void
    {
        $this->createLog($payload, self::WAHA_SUCCESS);
    }

    /**
     * Create a log entry.
     */
    protected function createLog(mixed $payload, string $status): void
    {
        // Check if logging is enabled in config
        if (!config('go-whatsapp.logging_enabled', false)) {
            return;
        }

        try {
            $jsonPayload = is_string($payload)
                ? $payload
                : json_encode($payload, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            GoWhatsAppLog::create([
                'payload' => $jsonPayload,
                'status' => $status,
            ]);
        } catch (JsonException $e) {
            Log::error('Failed to encode payload for GoWhatsAppLog', [
                'payload' => $payload,
                'exception' => $e->getMessage(),
            ]);
        }
    }
}

