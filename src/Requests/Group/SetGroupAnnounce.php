<?php

namespace Zifala\GoWhatsApp\Requests\Group;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * setGroupAnnounce
 *
 * Enable/disable announce mode so only admins can send messages
 */
class SetGroupAnnounce extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/group/announce";
	}


	public function __construct()
	{
	}
}
