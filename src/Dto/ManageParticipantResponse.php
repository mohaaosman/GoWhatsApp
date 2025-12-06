<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Data as SpatieData;

class ManageParticipantResponse extends SpatieData
{
	public function __construct(
		public ?string $code = null,
		public ?string $message = null,
		public ?array $results = null,
	) {
	}
}
