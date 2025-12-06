<?php

namespace Zifala\GoWhatsApp\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Requests\Send\SendAudio;
use Zifala\GoWhatsApp\Requests\Send\SendChatPresence;
use Zifala\GoWhatsApp\Requests\Send\SendContact;
use Zifala\GoWhatsApp\Requests\Send\SendFile;
use Zifala\GoWhatsApp\Requests\Send\SendImage;
use Zifala\GoWhatsApp\Requests\Send\SendLink;
use Zifala\GoWhatsApp\Requests\Send\SendLocation;
use Zifala\GoWhatsApp\Requests\Send\SendMessage;
use Zifala\GoWhatsApp\Requests\Send\SendPoll;
use Zifala\GoWhatsApp\Requests\Send\SendPresence;
use Zifala\GoWhatsApp\Requests\Send\SendVideo;

class Send extends BaseResource
{
	public function sendMessage(): Response
	{
		return $this->connector->send(new SendMessage());
	}


	public function sendImage(): Response
	{
		return $this->connector->send(new SendImage());
	}


	public function sendAudio(): Response
	{
		return $this->connector->send(new SendAudio());
	}


	public function sendFile(): Response
	{
		return $this->connector->send(new SendFile());
	}


	public function sendVideo(): Response
	{
		return $this->connector->send(new SendVideo());
	}


	public function sendContact(): Response
	{
		return $this->connector->send(new SendContact());
	}


	public function sendLink(): Response
	{
		return $this->connector->send(new SendLink());
	}


	public function sendLocation(): Response
	{
		return $this->connector->send(new SendLocation());
	}


	public function sendPoll(): Response
	{
		return $this->connector->send(new SendPoll());
	}


	public function sendPresence(): Response
	{
		return $this->connector->send(new SendPresence());
	}


	public function sendChatPresence(): Response
	{
		return $this->connector->send(new SendChatPresence());
	}
}
