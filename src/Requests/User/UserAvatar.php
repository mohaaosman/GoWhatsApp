<?php

namespace Zifala\GoWhatsApp\Requests\User;

use DateTime;
use Saloon\Enums\Method;
use Saloon\Http\Request;

/**
 * userAvatar
 */
class UserAvatar extends Request
{
	protected Method $method = Method::GET;


	public function resolveEndpoint(): string
	{
		return "/user/avatar";
	}


	/**
	 * @param null|string $phone Phone number with country code
	 * @param null|bool $isPreview Whether to fetch a preview of the avatar
	 * @param null|bool $isCommunity Whether to fetch a community avatar
	 */
	public function __construct(
		protected ?string $phone = null,
		protected ?bool $isPreview = null,
		protected ?bool $isCommunity = null,
	) {
	}


	public function defaultQuery(): array
	{
		return array_filter(['phone' => $this->phone, 'is_preview' => $this->isPreview, 'is_community' => $this->isCommunity]);
	}
}
