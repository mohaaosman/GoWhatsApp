<?php

namespace Zifala\GoWhatsApp\Requests\User;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * userMyGroups
 */
class UserMyGroups extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/user/my/groups";
	}


	public function __construct()
	{
	}
}
