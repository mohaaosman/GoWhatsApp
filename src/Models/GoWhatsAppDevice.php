<?php

namespace Zifala\GoWhatsApp\Models;

use Illuminate\Database\Eloquent\Model;
use Zifala\GoWhatsApp\Traits\HasApp;
use Zifala\GoWhatsApp\Traits\HasSend;
use Zifala\GoWhatsApp\Traits\HasAccount;
use Zifala\GoWhatsApp\Traits\HasChatManagement;
use Zifala\GoWhatsApp\GoWhatsAppConnector;

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
     * Get the single active device instance.
     * Uses the first device found in the database, or creates one from config/API.
     */
    public static function getDevice(): self
    {
        // 1. Try to find the first device in DB
        $device = self::first();

        if ($device) {
            return $device;
        }

        // 2. If not in DB, try to fetch from API and create
        $connector = new GoWhatsAppConnector();
        try {
            $response = $connector->app()->appDevices();
            if ($response->successful()) {
                $data = $response->json();
                // Handle response structure: ["session1"] or [{"name": "session1"}]
                $sessions = isset($data['results']) ? $data['results'] : (isset($data['data']) ? $data['data'] : $data);
                
                if (is_array($sessions) && count($sessions) > 0) {
                    $firstSession = $sessions[0];
                    $name = is_string($firstSession) ? $firstSession : ($firstSession['name'] ?? 'default');
                    
                    return self::create([
                        'name' => $name,
                        'base_url' => config('go-whatsapp.base_url'),
                        'username' => config('go-whatsapp.username'),
                        'password' => config('go-whatsapp.password'),
                    ]);
                }
            }
        } catch (\Exception $e) {
            // API unreachable or empty
        }

        // 3. Fallback: Create from Config
        return self::create([
            'name' => 'Default Device',
            'base_url' => config('go-whatsapp.base_url'),
            'username' => config('go-whatsapp.username'),
            'password' => config('go-whatsapp.password'),
        ]);
    }
}
