<?php

namespace Zifala\GoWhatsApp\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Requests\App\AppDevices;
use Zifala\GoWhatsApp\Requests\App\AppLogin;
use Zifala\GoWhatsApp\Requests\App\AppLoginWithCode;
use Zifala\GoWhatsApp\Requests\App\AppLogout;
use Zifala\GoWhatsApp\Requests\App\AppReconnect;

class App extends BaseResource
{
	public function appLogin(): Response
	{
		return $this->connector->send(new AppLogin());
	}


	/**
	 * @param string $phone Your phone number
	 */
	public function appLoginWithCode(?string $phone = null): Response
	{
		return $this->connector->send(new AppLoginWithCode($phone));
	}


	public function appLogout(): Response
	{
		return $this->connector->send(new AppLogout());
	}


	public function appReconnect(): Response
	{
		return $this->connector->send(new AppReconnect());
	}


	public function appDevices(): Response
	{
		return $this->connector->send(new AppDevices());
	}
}
