<?php

namespace Zifala\GoWhatsApp\Requests\Group;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * getGroupInfoFromLink
 *
 * Retrieve group information without joining the group using its invitation link
 */
class GetGroupInfoFromLink extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/group/info-from-link";
	}


	/**
	 * @param string $link WhatsApp group invitation link
	 */
	public function __construct(
		protected string $link,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['link' => $this->link]);
	}
}
