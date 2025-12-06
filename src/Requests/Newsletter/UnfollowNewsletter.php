<?php

namespace Zifala\GoWhatsApp\Requests\Newsletter;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * unfollowNewsletter
 */
class UnfollowNewsletter extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/newsletter/unfollow";
	}


	public function __construct()
	{
	}
}
