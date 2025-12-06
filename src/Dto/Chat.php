<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Chat extends SpatieData
{
	public function __construct(
		public ?string $jid = null,
		public ?string $name = null,
		#[MapName('last_message_time')]
		public ?string $lastMessageTime = null,
		#[MapName('ephemeral_expiration')]
		public ?int $ephemeralExpiration = null,
		#[MapName('created_at')]
		public ?string $createdAt = null,
		#[MapName('updated_at')]
		public ?string $updatedAt = null,
	) {
	}
}
