<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class ManageParticipantRequest extends SpatieData
{
	public function __construct(
		#[MapName('group_id')]
		public ?string $groupId = null,
		public ?array $participants = null,
	) {
	}
}
