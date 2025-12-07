<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\User\UserAvatar;
use Zifala\GoWhatsApp\Requests\User\UserChangeAvatar;
use Zifala\GoWhatsApp\Requests\User\UserCheck;
use Zifala\GoWhatsApp\Requests\User\UserInfo;
use Saloon\Data\MultipartValue;

trait HasAccount
{
    use FormatPhone;
    use HasConnector;

    public function avatar(string $phone, bool $isPreview = false, bool $isCommunity = false)
    {
        $phone = $this->formatPhone($phone);
        $request = new UserAvatar($phone, $isPreview, $isCommunity);
        return $this->connector()->send($request);
    }

    public function changeAvatar(string $avatarPath)
    {
        $request = new UserChangeAvatar();
        
        if (!file_exists($avatarPath)) {
            throw new \InvalidArgumentException("File not found: " . $avatarPath);
        }
        $content = file_get_contents($avatarPath);
        if ($content === false) {
             throw new \RuntimeException("Failed to read file content: " . $avatarPath);
        }
        
        $request->body()->add('avatar', new MultipartValue('avatar', $content, basename($avatarPath)));
        return $this->connector()->send($request);
    }

    /**
     * Check if user exists.
     * Returns the raw Saloon Response for detailed inspection.
     */
    public function checkUser(string $phone)
    {
        $phone = $this->formatPhone($phone);
        $request = new UserCheck($phone);
        return $this->connector()->send($request);
    }

    public function userInfo(string $phone)
    {
        $phone = $this->formatPhone($phone);
        $request = new UserInfo($phone);
        return $this->connector()->send($request);
    }
    
    /**
     * Check if a number exists on WhatsApp (Boolean wrapper)
     */
    public function numberExists(string $phone): bool
    {
        $response = $this->checkUser($phone);
        
        if ($response->failed()) {
            return false;
        }

        $data = $response->json();
        
        // Parse the nested "results.is_on_whatsapp" structure
        if (isset($data['results']['is_on_whatsapp'])) {
            return (bool) $data['results']['is_on_whatsapp'];
        }

        // Fallback for different API versions or unexpected structures
        return $response->status() === 200;
    }
}
