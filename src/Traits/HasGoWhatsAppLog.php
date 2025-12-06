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
            // We pass the payload directly. 
            // The GoWhatsAppLog model has cast 'payload' => 'array', so Eloquent handles JSON serialization.
            GoWhatsAppLog::create([
                'payload' => $payload,
                'status' => $status,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create GoWhatsAppLog', [
                'payload' => $payload,
                'exception' => $e->getMessage(),
            ]);
        }
    }
}
