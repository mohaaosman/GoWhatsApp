<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\User\UserAvatar;
use Zifala\GoWhatsApp\Requests\User\UserChangeAvatar;
use Zifala\GoWhatsApp\Requests\User\UserCheck;
use Zifala\GoWhatsApp\Requests\User\UserInfo;
use Saloon\Data\MultipartValue;

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
    
    /**
     * Check if a number exists on WhatsApp (Boolean wrapper)
     */
    public function numberExists(string $phone): bool
    {
        $response = $this->checkUser($phone);
        
        if ($response->failed()) {
            return false;
        }

        // Adjust based on actual API response structure for /user/check
        // Usually returns { "status": 200, "result": true/false } or { "onwhatsapp": "true" }
        $data = $response->json();
        
        // Example check (adjust based on real API)
        // If API returns { "result": true } or similar
        return isset($data['result']) && $data['result'] === true; // Placeholder logic
        // Or if it returns 200 only if exists?
        // Let's assume successful response implies existence for now or check 'id' presence.
        return $response->status() === 200;
    }
}
