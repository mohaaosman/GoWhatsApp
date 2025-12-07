<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\Chat\ListChats;
use Zifala\GoWhatsApp\Requests\Chat\GetChatMessages;

trait HasChatManagement
{
    use HasConnector;

    public function chatList(int $limit = 25, int $offset = 0, ?string $search = null, bool $hasMedia = false)
    {
        $request = new ListChats($limit, $offset, $search, $hasMedia);
        return $this->connector()->send($request);
    }

    public function chatMessages(string $chatJid, int $limit = 50, int $offset = 0)
    {
        $request = new GetChatMessages($chatJid, $limit, $offset);
        return $this->connector()->send($request);
    }
}
