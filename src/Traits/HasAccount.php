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
        // Confirmed via read_file that UserAvatar accepts constructor args
        $request = new UserAvatar($phone, $isPreview, $isCommunity);
        return $this->connector()->send($request);
    }

    public function changeAvatar(string $avatar)
    {
        $request = new UserChangeAvatar();
        $multipart = new MultipartBodyRepository();
        // Assuming avatar is a file path or binary content. 
        // OpenAPI spec says "Avatar to send" with format binary.
        // Usually means file upload.
        $multipart->addFile('avatar', $avatar);
        $request->withBody($multipart);
        
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
