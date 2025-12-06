<?php

namespace Zifala\GoWhatsApp\Requests\Chat;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * listChats
 *
 * Retrieve a list of chat conversations with their basic information
 */
class ListChats extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/chats";
	}


	/**
	 * @param null|int $limit Maximum number of chats to return
	 * @param null|int $offset Number of chats to skip (for pagination)
	 * @param null|string $search Search chats by name
	 * @param null|bool $hasMedia Filter chats that contain media messages
	 */
	public function __construct(
		protected ?int $limit = null,
		protected ?int $offset = null,
		protected ?string $search = null,
		protected ?bool $hasMedia = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['limit' => $this->limit, 'offset' => $this->offset, 'search' => $this->search, 'has_media' => $this->hasMedia]);
	}
}
