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
        $request->withBody(new JsonBodyRepository($body));

        return $this->connector()->send($request);
    }

    public function sendImage(string $phone, string $imagePath, ?string $caption = null, bool $viewOnce = false, ?string $imageUrl = null, bool $compress = false)
    {
        $request = new SendImage();
        
        // Check if SendImage uses HasJsonBody (from generated code check).
        // The generated SendImage.php uses HasJsonBody.
        // However, the OpenAPI spec says multipart/form-data.
        // If the generated code forces HasJsonBody, we might have issues if we try to use Multipart.
        // But Saloon allows overriding the body repository.
        
        // If the server expects Multipart, we should use MultipartBodyRepository.
        
        $multipart = new MultipartBodyRepository();
        $multipart->add('phone', $phone);
        
        if ($imageUrl) {
            $multipart->add('image_url', $imageUrl);
        } else {
             // Assuming $imagePath is a file path
             $multipart->addFile('image', $imagePath);
        }
        
        if ($caption) $multipart->add('caption', $caption);
        if ($viewOnce) $multipart->add('view_once', $viewOnce ? 'true' : 'false');
        if ($compress) $multipart->add('compress', $compress ? 'true' : 'false');

        $request->withBody($multipart);

        return $this->connector()->send($request);
    }
    
    // Similarly for other media types if they are multipart in spec.
    // Assuming SendFile, SendVideo, SendAudio are multipart.
    
    public function sendFile(string $phone, string $filePath, ?string $caption = null)
    {
         $request = new SendFile();
         $multipart = new MultipartBodyRepository();
         $multipart->add('phone', $phone);
         $multipart->addFile('file', $filePath);
         if ($caption) $multipart->add('caption', $caption);
         
         $request->withBody($multipart);
         return $this->connector()->send($request);
    }

    public function sendVideo(string $phone, string $videoPath, ?string $caption = null, bool $viewOnce = false, ?string $videoUrl = null)
    {
         $request = new SendVideo();
         $multipart = new MultipartBodyRepository();
         $multipart->add('phone', $phone);
         if ($videoUrl) {
             $multipart->add('video_url', $videoUrl);
         } else {
             $multipart->addFile('video', $videoPath);
         }
         if ($caption) $multipart->add('caption', $caption);
         if ($viewOnce) $multipart->add('view_once', $viewOnce ? 'true' : 'false');
         
         $request->withBody($multipart);
         return $this->connector()->send($request);
    }

    public function sendAudio(string $phone, string $audioPath, ?string $audioUrl = null)
    {
         $request = new SendAudio();
         $multipart = new MultipartBodyRepository();
         $multipart->add('phone', $phone);
         if ($audioUrl) {
             $multipart->add('audio_url', $audioUrl);
         } else {
             $multipart->addFile('audio', $audioPath);
         }
         
         $request->withBody($multipart);
         return $this->connector()->send($request);
    }

    public function sendPresence(string $type, bool $isForwarded = false)
    {
        $request = new SendPresence();
        $body = [
            'type' => $type,
            'is_forwarded' => $isForwarded,
        ];
        $request->withBody(new JsonBodyRepository($body));
        return $this->connector()->send($request);
    }

    public function sendChatPresence(string $phone, string $action)
    {
        $request = new SendChatPresence();
         $body = [
            'phone' => $phone,
            'action' => $action,
        ];
        $request->withBody(new JsonBodyRepository($body));
        return $this->connector()->send($request);
    }
}
