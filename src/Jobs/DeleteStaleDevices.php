<?php

namespace Zifala\GoWhatsApp\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;

class DeleteStaleDevices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The IDs of the devices to delete.
     *
     * @var array
     */
    protected $deviceIds;

    /**
     * Create a new job instance.
     *
     * @param array $deviceIds
     */
    public function __construct(array $deviceIds)
    {
        $this->deviceIds = $deviceIds;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        GoWhatsAppDevice::whereIn('id', $this->deviceIds)->delete();
    }
}

