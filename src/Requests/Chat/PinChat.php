<?php

namespace Zifala\GoWhatsApp\Requests\Chat;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * pinChat
 *
 * Pin or unpin a chat conversation to the top of the chat list
 */
class PinChat extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/chat/{$this->chatJid}/pin";
	}


	/**
	 * @param string $chatJid Chat JID (e.g., phone@s.whatsapp.net for individual or groupid@g.us for group)
	 */
	public function __construct(
		protected string $chatJid,
	) {
	}
}
