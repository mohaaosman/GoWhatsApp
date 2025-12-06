<?php

namespace Zifala\GoWhatsApp\Requests\Chat;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * getChatMessages
 *
 * Retrieve messages from a specific chat conversation with filtering options
 */
class GetChatMessages extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/chat/{$this->chatJid}/messages";
	}


	/**
	 * @param string $chatJid Chat JID (e.g., phone@s.whatsapp.net for individual or groupid@g.us for group)
	 * @param null|int $limit Maximum number of messages to return
	 * @param null|int $offset Number of messages to skip (for pagination)
	 * @param null|string $startTime Filter messages from this timestamp (ISO 8601 format)
	 * @param null|string $endTime Filter messages until this timestamp (ISO 8601 format)
	 * @param null|bool $mediaOnly Only return messages with media content
	 * @param null|bool $isFromMe Filter messages by sender (true for messages sent by you, false for received messages). When both media_only=true and isFromMe=false are provided, media_only takes precedence and will return all media messages regardless of sender.
	 * @param null|string $search Search messages by content text
	 */
	public function __construct(
		protected string $chatJid,
		protected ?int $limit = null,
		protected ?int $offset = null,
		protected ?string $startTime = null,
		protected ?string $endTime = null,
		protected ?bool $mediaOnly = null,
		protected ?bool $isFromMe = null,
		protected ?string $search = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter([
			'limit' => $this->limit,
			'offset' => $this->offset,
			'start_time' => $this->startTime,
			'end_time' => $this->endTime,
			'media_only' => $this->mediaOnly,
			'is_from_me' => $this->isFromMe,
			'search' => $this->search,
		]);
	}
}
