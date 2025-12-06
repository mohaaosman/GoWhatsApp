<?php

namespace Zifala\GoWhatsApp\Requests\User;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * userInfo
 */
class UserInfo extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/user/info";
	}


	/**
	 * @param null|string $phone Phone number with country code
	 */
	public function __construct(
		protected ?string $phone = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['phone' => $this->phone]);
	}
}
