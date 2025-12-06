<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Data as SpatieData;

class MyListContacts extends SpatieData
{
	public function __construct(
		public ?string $jid = null,
		public ?string $name = null,
	) {
	}
}
