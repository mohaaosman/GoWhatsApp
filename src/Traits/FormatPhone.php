<?php

namespace Zifala\GoWhatsApp\Traits;

trait FormatPhone
{
    /**
     * Format phone number to WhatsApp JID format.
     */
    protected function formatPhone(string $phone): string
    {
        // Remove any non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Append suffix if not present
        if (!str_ends_with($phone, '@s.whatsapp.net')) {
            $phone .= '@s.whatsapp.net';
        }
        
        return $phone;
    }
}

