<?php

namespace Zifala\GoWhatsApp\Requests\User;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * userBusinessProfile
 *
 * Retrieve detailed business profile information for a WhatsApp business account
 */
class UserBusinessProfile extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/user/business-profile";
	}


	/**
	 * @param string $phone Phone number with country code of the business account
	 */
	public function __construct(
		protected string $phone,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['phone' => $this->phone]);
	}
}
