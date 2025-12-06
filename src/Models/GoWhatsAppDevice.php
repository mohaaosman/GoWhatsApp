<?php

namespace Zifala\GoWhatsApp\Models;

use Illuminate\Database\Eloquent\Model;
use Zifala\GoWhatsApp\Traits\HasApp;
use Zifala\GoWhatsApp\Traits\HasSend;
use Zifala\GoWhatsApp\Traits\HasAccount;
use Zifala\GoWhatsApp\Traits\HasChatManagement;
use Zifala\GoWhatsApp\GoWhatsAppConnector;
use Zifala\GoWhatsApp\Jobs\DeleteStaleDevices;

class GoWhatsAppDevice extends Model
{
    use HasApp, HasSend, HasAccount, HasChatManagement;

    protected $guarded = [];
    protected $table = 'go_whatsapp_devices';

    public function connector(): GoWhatsAppConnector
    {
        return new GoWhatsAppConnector(
            baseUrl: $this->base_url,
            username: $this->username,
            password: $this->password
        );
    }

    /**
     * Sync devices with the server.
     * Fetches all sessions from the server, updates/creates them in the DB,
     * and deletes local devices that are no longer on the server.
     */
    public static function sync(): void
    {
        // Use default config to connect to the server (assuming it manages the sessions)
        $connector = new GoWhatsAppConnector();
        
        try {
            // Fetch devices from server
            // Using the 'appDevices' request via the connector's 'app' resource
            $response = $connector->app()->appDevices();
        } catch (\Exception $e) {
            // Log error or rethrow depending on preference. For now, just return.
            return;
        }

        if ($response->failed()) {
            return;
        }

        // Assuming response is a list of session names (strings) or objects with 'name'
        $serverSessions = $response->json();
        
        // If wrapped in 'data' or 'results' key, adjust here. 
        // Based on typical behavior, let's look for a key if the root is an assoc array
        if (is_array($serverSessions) && !array_is_list($serverSessions) && isset($serverSessions['results'])) {
             $serverSessions = $serverSessions['results'];
        } elseif (is_array($serverSessions) && !array_is_list($serverSessions) && isset($serverSessions['data'])) {
             $serverSessions = $serverSessions['data'];
        }

        if (!is_array($serverSessions)) {
            return;
        }

        $activeIds = [];

        foreach ($serverSessions as $sessionData) {
            // Handle both string array ["session1"] and object array [{"name": "session1"}]
            $name = is_string($sessionData) ? $sessionData : ($sessionData['name'] ?? null);

            if ($name) {
                // Update or create the device record
                // We use the config credentials as defaults since the server manages them
                $device = self::updateOrCreate(
                    ['name' => $name], 
                    [
                        'base_url' => config('go-whatsapp.base_url'),
                        'username' => config('go-whatsapp.username'),
                        'password' => config('go-whatsapp.password'),
                        // 'phone' => ... we might not know the phone number from just the listing
                    ]
                );
                $activeIds[] = $device->id;
            }
        }

        // Identify stale devices (in DB but not in server list)
        $staleDeviceIds = self::whereNotIn('id', $activeIds)->pluck('id')->toArray();

        // Dispatch background job to delete them
        if (!empty($staleDeviceIds)) {
            DeleteStaleDevices::dispatch($staleDeviceIds);
        }
    }
}
