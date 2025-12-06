<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Results extends SpatieData
{
	public function __construct(
		#[MapName('group_id')]
		public ?string $groupId = null,
	) {
	}
}
