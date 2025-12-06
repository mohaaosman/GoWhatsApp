<?php

namespace Zifala\GoWhatsApp\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Requests\Newsletter\UnfollowNewsletter;

class Newsletter extends BaseResource
{
	public function unfollowNewsletter(): Response
	{
		return $this->connector->send(new UnfollowNewsletter());
	}
}
