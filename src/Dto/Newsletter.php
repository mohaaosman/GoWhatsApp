<?php

namespace Zifala\GoWhatsApp\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Newsletter extends SpatieData
{
	public function __construct(
		public ?string $id = null,
		public ?object $state = null,
		#[MapName('thread_metadata')]
		public ?object $threadMetadata = null,
		#[MapName('viewer_metadata')]
		public ?object $viewerMetadata = null,
	) {
	}
}
