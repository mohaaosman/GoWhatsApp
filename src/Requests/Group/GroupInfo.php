<?php

namespace Zifala\GoWhatsApp\Requests\Group;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * groupInfo
 */
class GroupInfo extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/group/info";
	}


	/**
	 * @param null|string $groupId WhatsApp Group ID
	 */
	public function __construct(
		protected ?string $groupId = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['group_id' => $this->groupId]);
	}
}
