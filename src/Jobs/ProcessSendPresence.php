<?php

namespace Zifala\GoWhatsApp\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;

class ProcessSendPresence implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $type,
        public bool $isForwarded = false
    ) {
        $this->onConnection(config('go-whatsapp.queue_connection', 'sync'));
        $this->onQueue(config('go-whatsapp.queue_name', 'default'));
    }

    public function handle(): void
    {
        GoWhatsAppDevice::getDevice()->sendPresence(
            type: $this->type,
            isForwarded: $this->isForwarded,
            forceSync: true
        );
    }
}
