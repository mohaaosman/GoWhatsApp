<?php

namespace Zifala\GoWhatsApp\Requests\App;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * appDevices
 */
class AppDevices extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/app/devices";
	}


	public function __construct()
	{
	}
}
