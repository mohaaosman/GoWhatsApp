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
}
