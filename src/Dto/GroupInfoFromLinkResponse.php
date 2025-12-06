<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Data as SpatieData;

class GroupInfoFromLinkResponse extends SpatieData
{
	public function __construct(
		public ?string $code = null,
		public ?string $message = null,
		public ?object $results = null,
	) {
	}
}
