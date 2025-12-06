<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Participant extends SpatieData
{
	public function __construct(
		#[MapName('JID')]
		public ?string $jid = null,
		#[MapName('LID')]
		public ?string $lid = null,
		#[MapName('IsAdmin')]
		public ?bool $isAdmin = null,
		#[MapName('IsSuperAdmin')]
		public ?bool $isSuperAdmin = null,
		#[MapName('DisplayName')]
		public ?string $displayName = null,
		#[MapName('Error')]
		public ?int $error = null,
		#[MapName('AddRequest')]
		public ?string $addRequest = null,
	) {
	}
}
