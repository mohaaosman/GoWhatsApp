<?php

namespace Zifala\GoWhatsApp\Models;

use Illuminate\Database\Eloquent\Model;

class GoWhatsAppLog extends Model
{
    protected $guarded = [];

    protected $table = 'go_whatsapp_logs';

    protected $casts = [
        'payload' => 'array',
    ];
}
