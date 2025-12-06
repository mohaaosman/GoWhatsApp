<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Data as SpatieData;

class UserGroupInfoResponse extends SpatieData
{
	public function __construct(
		public ?int $status = null,
		public ?string $code = null,
		public ?string $message = null,
		public ?object $results = null,
	) {
	}
}
