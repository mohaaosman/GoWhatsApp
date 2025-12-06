<?php

namespace Zifala\GoWhatsApp\Requests\App;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * appReconnect
 */
class AppReconnect extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/app/reconnect";
	}


	public function __construct()
	{
	}
}
