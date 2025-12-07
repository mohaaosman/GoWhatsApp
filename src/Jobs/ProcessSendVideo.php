<?php

namespace Zifala\GoWhatsApp\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;

class ProcessSendVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $phone,
        public string $video,
        public ?string $caption = null
    ) {
        $this->onConnection(config('go-whatsapp.queue_connection', 'sync'));
        $this->onQueue(config('go-whatsapp.queue_name', 'default'));
    }

    public function handle(): void
    {
        GoWhatsAppDevice::getDevice()->sendVideo(
            phone: $this->phone,
            video: $this->video,
            caption: $this->caption,
            forceSync: true
        );
    }
}
