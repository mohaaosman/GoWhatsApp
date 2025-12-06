<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\User\UserAvatar;
use Zifala\GoWhatsApp\Requests\User\UserChangeAvatar;
use Zifala\GoWhatsApp\Requests\User\UserCheck;
use Zifala\GoWhatsApp\Requests\User\UserInfo;
use Saloon\Repositories\Body\MultipartBodyRepository;

trait HasAccount
{
    public function avatar(string $phone, bool $isPreview = false, bool $isCommunity = false)
    {
        $request = new UserAvatar($phone, $isPreview, $isCommunity);
        return $this->connector()->send($request);
    }

    public function changeAvatar(string $avatarPath)
    {
        $request = new UserChangeAvatar();
        $request->body()->addFile('avatar', $avatarPath);
        return $this->connector()->send($request);
    }

    public function checkUser(string $phone)
    {
        $request = new UserCheck($phone);
        return $this->connector()->send($request);
    }

    public function userInfo(string $phone)
    {
        $request = new UserInfo($phone);
        return $this->connector()->send($request);
    }
}
