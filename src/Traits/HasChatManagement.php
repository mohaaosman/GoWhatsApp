<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\Chat\ListChats;
use Zifala\GoWhatsApp\Requests\Chat\GetChatMessages;

trait HasChatManagement
{
    public function chatList(int $limit = 25, int $offset = 0, ?string $search = null, bool $hasMedia = false)
    {
        // Confirmed via read_file that ListChats accepts constructor args
        $request = new ListChats($limit, $offset, $search, $hasMedia);
        return $this->connector()->send($request);
    }

    public function chatMessages(string $chatJid, int $limit = 50, int $offset = 0)
    {
        // Confirmed via read_file that GetChatMessages accepts constructor args
        $request = new GetChatMessages($chatJid, $limit, $offset);
        return $this->connector()->send($request);
    }
}
