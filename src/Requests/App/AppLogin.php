<?php

namespace Zifala\GoWhatsApp\Requests\App;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * appLogin
 */
class AppLogin extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/app/login";
	}


	public function __construct()
	{
	}
}
