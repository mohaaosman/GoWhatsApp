<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class ChatMessage extends SpatieData
{
	public function __construct(
		public ?string $id = null,
		#[MapName('chat_jid')]
		public ?string $chatJid = null,
		#[MapName('sender_jid')]
		public ?string $senderJid = null,
		public ?string $content = null,
		public ?string $timestamp = null,
		#[MapName('is_from_me')]
		public ?bool $isFromMe = null,
		#[MapName('media_type')]
		public ?string $mediaType = null,
		public ?string $filename = null,
		public ?string $url = null,
		#[MapName('file_length')]
		public ?int $fileLength = null,
		#[MapName('created_at')]
		public ?string $createdAt = null,
		#[MapName('updated_at')]
		public ?string $updatedAt = null,
	) {
	}
}
