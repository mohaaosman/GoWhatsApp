<?php

namespace Zifala\GoWhatsApp\Traits;

trait HasApp
{
    public function login()
    {
        return $this->connector()->app()->appLogin();
    }

    public function logout()
    {
        return $this->connector()->app()->appLogout();
    }

    public function reconnect()
    {
        return $this->connector()->app()->appReconnect();
    }

    public function loginWithCode(?string $phone = null)
    {
        return $this->connector()->app()->appLoginWithCode($phone);
    }

    public function devices()
    {
        return $this->connector()->app()->appDevices();
    }
}
