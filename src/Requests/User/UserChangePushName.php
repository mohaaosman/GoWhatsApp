<?php

namespace Zifala\GoWhatsApp\Requests\User;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * userChangePushName
 *
 * Update the display name (push name) shown to others in WhatsApp
 */
class UserChangePushName extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/user/pushname";
	}


	public function __construct()
	{
	}
}
