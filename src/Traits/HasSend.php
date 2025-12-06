<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\Send\SendMessage;
use Zifala\GoWhatsApp\Requests\Send\SendImage;
use Zifala\GoWhatsApp\Requests\Send\SendFile;
use Zifala\GoWhatsApp\Requests\Send\SendVideo;
use Zifala\GoWhatsApp\Requests\Send\SendAudio;
use Zifala\GoWhatsApp\Requests\Send\SendPresence;
use Zifala\GoWhatsApp\Requests\Send\SendChatPresence;
use Saloon\Repositories\Body\JsonBodyRepository;
use Saloon\Repositories\Body\MultipartBodyRepository;
use Saloon\Data\MultipartValue;

trait HasSend
{
    public function sendMessage(string $phone, string $message, ?string $replyMessageId = null)
    {
        $request = new SendMessage();
        $body = [
            'phone' => $phone,
            'message' => $message,
        ];
        if ($replyMessageId) {
            $body['reply_message_id'] = $replyMessageId;
        }
        $request->body()->set($body);

        return $this->connector()->send($request);
    }

    public function sendImage(string $phone, string $imagePath, ?string $caption = null, bool $viewOnce = false, ?string $imageUrl = null, bool $compress = false)
    {
        $request = new SendImage();
        
        $request->body()->add('phone', $phone);
        
        if ($imageUrl) {
            $request->body()->add('image_url', $imageUrl);
        } else {
             $request->body()->addFile('image', $imagePath);
        }
        
        if ($caption) $request->body()->add('caption', $caption);
        if ($viewOnce) $request->body()->add('view_once', $viewOnce ? 'true' : 'false');
        if ($compress) $request->body()->add('compress', $compress ? 'true' : 'false');

        return $this->connector()->send($request);
    }
    
    public function sendFile(string $phone, string $filePath, ?string $caption = null)
    {
         $request = new SendFile();
         $request->body()->add('phone', $phone);
         $request->body()->addFile('file', $filePath);
         if ($caption) $request->body()->add('caption', $caption);
         
         return $this->connector()->send($request);
    }

    public function sendVideo(string $phone, string $videoPath, ?string $caption = null, bool $viewOnce = false, ?string $videoUrl = null)
    {
         $request = new SendVideo();
         $request->body()->add('phone', $phone);
         if ($videoUrl) {
             $request->body()->add('video_url', $videoUrl);
         } else {
             $request->body()->addFile('video', $videoPath);
         }
         if ($caption) $request->body()->add('caption', $caption);
         if ($viewOnce) $request->body()->add('view_once', $viewOnce ? 'true' : 'false');
         
         return $this->connector()->send($request);
    }

    public function sendAudio(string $phone, string $audioPath, ?string $audioUrl = null)
    {
         $request = new SendAudio();
         $request->body()->add('phone', $phone);
         if ($audioUrl) {
             $request->body()->add('audio_url', $audioUrl);
         } else {
             $request->body()->addFile('audio', $audioPath);
         }
         
         return $this->connector()->send($request);
    }

    public function sendPresence(string $type, bool $isForwarded = false)
    {
        $request = new SendPresence();
        $body = [
            'type' => $type,
            'is_forwarded' => $isForwarded,
        ];
        $request->body()->set($body);
        return $this->connector()->send($request);
    }

    public function sendChatPresence(string $phone, string $action)
    {
        $request = new SendChatPresence();
         $body = [
            'phone' => $phone,
            'action' => $action,
        ];
        $request->body()->set($body);
        return $this->connector()->send($request);
    }
}
