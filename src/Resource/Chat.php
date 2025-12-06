<?php

namespace Zifala\GoWhatsApp\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Requests\Chat\GetChatMessages;
use Zifala\GoWhatsApp\Requests\Chat\LabelChat;
use Zifala\GoWhatsApp\Requests\Chat\ListChats;
use Zifala\GoWhatsApp\Requests\Chat\PinChat;

class Chat extends BaseResource
{
	/**
	 * @param int $limit Maximum number of chats to return
	 * @param int $offset Number of chats to skip (for pagination)
	 * @param string $search Search chats by name
	 * @param bool $hasMedia Filter chats that contain media messages
	 */
	public function listChats(
		?int $limit = null,
		?int $offset = null,
		?string $search = null,
		?bool $hasMedia = null,
	): Response
	{
		return $this->connector->send(new ListChats($limit, $offset, $search, $hasMedia));
	}


	/**
	 * @param string $chatJid Chat JID (e.g., phone@s.whatsapp.net for individual or groupid@g.us for group)
	 * @param int $limit Maximum number of messages to return
	 * @param int $offset Number of messages to skip (for pagination)
	 * @param string $startTime Filter messages from this timestamp (ISO 8601 format)
	 * @param string $endTime Filter messages until this timestamp (ISO 8601 format)
	 * @param bool $mediaOnly Only return messages with media content
	 * @param bool $isFromMe Filter messages by sender (true for messages sent by you, false for received messages). When both media_only=true and isFromMe=false are provided, media_only takes precedence and will return all media messages regardless of sender.
	 * @param string $search Search messages by content text
	 */
	public function getChatMessages(
		string $chatJid,
		?int $limit = null,
		?int $offset = null,
		?string $startTime = null,
		?string $endTime = null,
		?bool $mediaOnly = null,
		?bool $isFromMe = null,
		?string $search = null,
	): Response
	{
		return $this->connector->send(new GetChatMessages($chatJid, $limit, $offset, $startTime, $endTime, $mediaOnly, $isFromMe, $search));
	}


	/**
	 * @param string $chatJid Chat JID (e.g., phone@s.whatsapp.net for individual or groupid@g.us for group)
	 */
	public function labelChat(string $chatJid): Response
	{
		return $this->connector->send(new LabelChat($chatJid));
	}


	/**
	 * @param string $chatJid Chat JID (e.g., phone@s.whatsapp.net for individual or groupid@g.us for group)
	 */
	public function pinChat(string $chatJid): Response
	{
		return $this->connector->send(new PinChat($chatJid));
	}
}
