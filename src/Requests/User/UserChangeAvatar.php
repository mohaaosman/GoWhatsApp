<?php

namespace Zifala\GoWhatsApp\Requests\User;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasMultipartBody;

/**
 * userChangeAvatar
 */
class UserChangeAvatar extends Request implements HasBody
{
	use HasMultipartBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/user/avatar";
	}


	public function __construct()
	{
	}
}
