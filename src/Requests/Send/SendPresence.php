<?php

namespace Zifala\GoWhatsApp\Requests\Send;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * sendPresence
 */
class SendPresence extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/send/presence";
	}


	public function __construct()
	{
	}
}
