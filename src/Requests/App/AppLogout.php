<?php

namespace Zifala\GoWhatsApp\Requests\App;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * appLogout
 */
class AppLogout extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/app/logout";
	}


	public function __construct()
	{
	}
}
