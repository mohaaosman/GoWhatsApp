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
             if (!file_exists($imagePath)) {
                 throw new \InvalidArgumentException("File not found: " . $imagePath);
             }
             $content = file_get_contents($imagePath);
             if ($content === false) {
                 throw new \RuntimeException("Failed to read file content: " . $imagePath);
             }
             // Ensure content is cast to string to be safe
             $request->body()->add('image', new MultipartValue('image', (string)$content, basename($imagePath)));
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
         
         if (!file_exists($filePath)) {
             throw new \InvalidArgumentException("File not found: " . $filePath);
         }
         $content = file_get_contents($filePath);
         if ($content === false) {
             throw new \RuntimeException("Failed to read file content: " . $filePath);
         }
         $request->body()->add('file', new MultipartValue('file', $content, basename($filePath)));
         
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
             if (!file_exists($videoPath)) {
                 throw new \InvalidArgumentException("File not found: " . $videoPath);
             }
             $content = file_get_contents($videoPath);
             if ($content === false) {
                 throw new \RuntimeException("Failed to read file content: " . $videoPath);
             }
             $request->body()->add('video', new MultipartValue('video', $content, basename($videoPath)));
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
             if (!file_exists($audioPath)) {
                 throw new \InvalidArgumentException("File not found: " . $audioPath);
             }
             $content = file_get_contents($audioPath);
             if ($content === false) {
                 throw new \RuntimeException("Failed to read file content: " . $audioPath);
             }
             $request->body()->add('audio', new MultipartValue('audio', $content, basename($audioPath)));
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
