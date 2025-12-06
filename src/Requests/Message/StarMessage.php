<?php

namespace Zifala\GoWhatsApp\Requests\Message;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * starMessage
 */
class StarMessage extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/message/{$this->messageId}/star";
	}


	/**
	 * @param string $messageId Message ID
	 */
	public function __construct(
		protected string $messageId,
	) {
	}
}
