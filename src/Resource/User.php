<?php

namespace Zifala\GoWhatsApp\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Requests\User\UserAvatar;
use Zifala\GoWhatsApp\Requests\User\UserBusinessProfile;
use Zifala\GoWhatsApp\Requests\User\UserChangeAvatar;
use Zifala\GoWhatsApp\Requests\User\UserChangePushName;
use Zifala\GoWhatsApp\Requests\User\UserCheck;
use Zifala\GoWhatsApp\Requests\User\UserInfo;
use Zifala\GoWhatsApp\Requests\User\UserMyContacts;
use Zifala\GoWhatsApp\Requests\User\UserMyGroups;
use Zifala\GoWhatsApp\Requests\User\UserMyNewsletter;
use Zifala\GoWhatsApp\Requests\User\UserMyPrivacy;

class User extends BaseResource
{
	/**
	 * @param string $phone Phone number with country code
	 */
	public function userInfo(?string $phone = null): Response
	{
		return $this->connector->send(new UserInfo($phone));
	}


	/**
	 * @param string $phone Phone number with country code
	 * @param bool $isPreview Whether to fetch a preview of the avatar
	 * @param bool $isCommunity Whether to fetch a community avatar
	 */
	public function userAvatar(?string $phone = null, ?bool $isPreview = null, ?bool $isCommunity = null): Response
	{
		return $this->connector->send(new UserAvatar($phone, $isPreview, $isCommunity));
	}


	public function userChangeAvatar(): Response
	{
		return $this->connector->send(new UserChangeAvatar());
	}


	public function userChangePushName(): Response
	{
		return $this->connector->send(new UserChangePushName());
	}


	public function userMyPrivacy(): Response
	{
		return $this->connector->send(new UserMyPrivacy());
	}


	public function userMyGroups(): Response
	{
		return $this->connector->send(new UserMyGroups());
	}


	public function userMyNewsletter(): Response
	{
		return $this->connector->send(new UserMyNewsletter());
	}


	public function userMyContacts(): Response
	{
		return $this->connector->send(new UserMyContacts());
	}


	/**
	 * @param string $phone Phone number with country code
	 */
	public function userCheck(?string $phone = null): Response
	{
		return $this->connector->send(new UserCheck($phone));
	}


	/**
	 * @param string $phone Phone number with country code of the business account
	 */
	public function userBusinessProfile(string $phone): Response
	{
		return $this->connector->send(new UserBusinessProfile($phone));
	}
}
