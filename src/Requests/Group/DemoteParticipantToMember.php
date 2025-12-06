<?php

namespace Zifala\GoWhatsApp\Requests\Group;

use DateTime;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

/**
 * demoteParticipantToMember
 */
class DemoteParticipantToMember extends Request implements HasBody
{
	use HasJsonBody;

	protected Method $method = Method::POST;


	public function resolveEndpoint(): string
	{
		return "/group/participants/demote";
	}


	public function __construct()
	{
	}
}
