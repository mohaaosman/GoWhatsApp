<?php

namespace Zifala\GoWhatsApp\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Requests\Group\AddParticipantToGroup;
use Zifala\GoWhatsApp\Requests\Group\ApproveGroupParticipantRequest;
use Zifala\GoWhatsApp\Requests\Group\CreateGroup;
use Zifala\GoWhatsApp\Requests\Group\DemoteParticipantToMember;
use Zifala\GoWhatsApp\Requests\Group\GetGroupInfoFromLink;
use Zifala\GoWhatsApp\Requests\Group\GetGroupParticipantRequests;
use Zifala\GoWhatsApp\Requests\Group\GroupInfo;
use Zifala\GoWhatsApp\Requests\Group\JoinGroupWithLink;
use Zifala\GoWhatsApp\Requests\Group\LeaveGroup;
use Zifala\GoWhatsApp\Requests\Group\PromoteParticipantToAdmin;
use Zifala\GoWhatsApp\Requests\Group\RejectGroupParticipantRequest;
use Zifala\GoWhatsApp\Requests\Group\RemoveParticipantFromGroup;
use Zifala\GoWhatsApp\Requests\Group\SetGroupAnnounce;
use Zifala\GoWhatsApp\Requests\Group\SetGroupLocked;
use Zifala\GoWhatsApp\Requests\Group\SetGroupName;
use Zifala\GoWhatsApp\Requests\Group\SetGroupPhoto;
use Zifala\GoWhatsApp\Requests\Group\SetGroupTopic;

class Group extends BaseResource
{
	/**
	 * @param string $groupId WhatsApp Group ID
	 */
	public function groupInfo(?string $groupId = null): Response
	{
		return $this->connector->send(new GroupInfo($groupId));
	}


	public function createGroup(): Response
	{
		return $this->connector->send(new CreateGroup());
	}


	public function addParticipantToGroup(): Response
	{
		return $this->connector->send(new AddParticipantToGroup());
	}


	public function removeParticipantFromGroup(): Response
	{
		return $this->connector->send(new RemoveParticipantFromGroup());
	}


	public function promoteParticipantToAdmin(): Response
	{
		return $this->connector->send(new PromoteParticipantToAdmin());
	}


	public function demoteParticipantToMember(): Response
	{
		return $this->connector->send(new DemoteParticipantToMember());
	}


	public function joinGroupWithLink(): Response
	{
		return $this->connector->send(new JoinGroupWithLink());
	}


	/**
	 * @param string $link WhatsApp group invitation link
	 */
	public function getGroupInfoFromLink(string $link): Response
	{
		return $this->connector->send(new GetGroupInfoFromLink($link));
	}


	/**
	 * @param string $groupId The group ID to get participant requests for
	 */
	public function getGroupParticipantRequests(string $groupId): Response
	{
		return $this->connector->send(new GetGroupParticipantRequests($groupId));
	}


	public function approveGroupParticipantRequest(): Response
	{
		return $this->connector->send(new ApproveGroupParticipantRequest());
	}


	public function rejectGroupParticipantRequest(): Response
	{
		return $this->connector->send(new RejectGroupParticipantRequest());
	}


	public function leaveGroup(): Response
	{
		return $this->connector->send(new LeaveGroup());
	}


	public function setGroupPhoto(): Response
	{
		return $this->connector->send(new SetGroupPhoto());
	}


	public function setGroupName(): Response
	{
		return $this->connector->send(new SetGroupName());
	}


	public function setGroupLocked(): Response
	{
		return $this->connector->send(new SetGroupLocked());
	}


	public function setGroupAnnounce(): Response
	{
		return $this->connector->send(new SetGroupAnnounce());
	}


	public function setGroupTopic(): Response
	{
		return $this->connector->send(new SetGroupTopic());
	}
}
