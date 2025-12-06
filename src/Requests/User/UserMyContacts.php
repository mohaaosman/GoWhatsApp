<?php

namespace Zifala\GoWhatsApp\Requests\User;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * userMyContacts
 */
class UserMyContacts extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/user/my/contacts";
	}


	public function __construct()
	{
	}
}
