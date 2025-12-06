<?php

namespace Zifala\GoWhatsApp\Resource;

use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use Zifala\GoWhatsApp\Requests\Message\DeleteMessage;
use Zifala\GoWhatsApp\Requests\Message\ReactMessage;
use Zifala\GoWhatsApp\Requests\Message\ReadMessage;
use Zifala\GoWhatsApp\Requests\Message\RevokeMessage;
use Zifala\GoWhatsApp\Requests\Message\StarMessage;
use Zifala\GoWhatsApp\Requests\Message\UnstarMessage;
use Zifala\GoWhatsApp\Requests\Message\UpdateMessage;

class Message extends BaseResource
{
	/**
	 * @param string $messageId Message ID
	 */
	public function revokeMessage(string $messageId): Response
	{
		return $this->connector->send(new RevokeMessage($messageId));
	}


	/**
	 * @param string $messageId Message ID
	 */
	public function deleteMessage(string $messageId): Response
	{
		return $this->connector->send(new DeleteMessage($messageId));
	}


	/**
	 * @param string $messageId Message ID
	 */
	public function reactMessage(string $messageId): Response
	{
		return $this->connector->send(new ReactMessage($messageId));
	}


	/**
	 * @param string $messageId Message ID
	 */
	public function updateMessage(string $messageId): Response
	{
		return $this->connector->send(new UpdateMessage($messageId));
	}


	/**
	 * @param string $messageId Message ID
	 */
	public function readMessage(string $messageId): Response
	{
		return $this->connector->send(new ReadMessage($messageId));
	}


	/**
	 * @param string $messageId Message ID
	 */
	public function starMessage(string $messageId): Response
	{
		return $this->connector->send(new StarMessage($messageId));
	}


	/**
	 * @param string $messageId Message ID
	 */
	public function unstarMessage(string $messageId): Response
	{
		return $this->connector->send(new UnstarMessage($messageId));
	}
}
