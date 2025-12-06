<?php

namespace Zifala\GoWhatsApp\Traits;

use Zifala\GoWhatsApp\Requests\Send\SendMessage;
use Zifala\GoWhatsApp\Requests\Send\SendImage;
use Zifala\GoWhatsApp\Requests\Send\SendFile;
use Zifala\GoWhatsApp\Requests\Send\SendVideo;
use Zifala\GoWhatsApp\Requests\Send\SendAudio;
use Zifala\GoWhatsApp\Requests\Send\SendPresence;
use Zifala\GoWhatsApp\Requests\Send\SendChatPresence;
use Saloon\Data\MultipartValue;

trait HasSend
{
    // Use formatPhone from separate trait if needed, 
    // or assume the main class uses it.
    // However, traits can't easily share protected methods unless composed.
    // Best practice: The Model uses FormatPhone, and traits just call $this->formatPhone().
    // But traits don't know about each other.
    // Solution: Require the method to exist (abstract) or use a helper trait included in the Model.
    
    // Abstract requirement
    // abstract protected function formatPhone(string $phone): string;
    
    // Better: We assume the class using this trait also uses FormatPhone trait.
    // PHP doesn't enforce this check at compile time for method existence on $this 
    // inside a trait unless we define abstract.
    
    // To solve collision: remove formatPhone definition from here.
    
    /**
     * Validate prerequisites before sending.
     * Checks if device is connected and optionally if the number exists.
     * 
     * @param string $phone
     * @param bool $checkNumber Whether to verify number existence on WA (adds latency)
     * @throws \RuntimeException If validation fails
     */
    protected function validatePreSending(string $phone, bool $checkNumber = false): void
    {
        if ($checkNumber) {
            if (!$this->numberExists($phone)) {
                throw new \RuntimeException("Phone number {$phone} does not exist on WhatsApp.");
            }
        }
    }

    public function sendMessage(string $phone, string $message, ?string $replyTo = null)
    {
        $phone = $this->formatPhone($phone);
        $this->validatePreSending($phone);

        $request = new SendMessage();
        $body = [
            'phone' => $phone,
            'message' => $message,
        ];
        if ($replyTo) {
            $body['reply_message_id'] = $replyTo;
        }
        $request->body()->set($body);

        return $this->connector()->send($request);
    }

    public function sendImage(string $phone, string $image, ?string $caption = null)
    {
        $phone = $this->formatPhone($phone);
        $this->validatePreSending($phone);

        $request = new SendImage();
        $request->body()->add('phone', $phone);

        if (filter_var($image, FILTER_VALIDATE_URL)) {
             $request->body()->add('image_url', $image);
        } else {
             if (!file_exists($image)) {
                 throw new \InvalidArgumentException("Image file not found: " . $image);
             }
             $content = file_get_contents($image);
             if ($content === false) {
                 throw new \RuntimeException("Failed to read image file: " . $image);
             }
             $request->body()->add('image', new MultipartValue('image', (string)$content, basename($image)));
        }

        if ($caption) $request->body()->add('caption', $caption);
        $request->body()->add('view_once', 'false');
        $request->body()->add('compress', 'false');

        return $this->connector()->send($request);
    }

    public function sendFile(string $phone, string $file, ?string $caption = null)
    {
        $phone = $this->formatPhone($phone);
        $this->validatePreSending($phone);

        $request = new SendFile();
        $request->body()->add('phone', $phone);

        if (!file_exists($file)) {
             throw new \InvalidArgumentException("File not found: " . $file);
        }
        $content = file_get_contents($file);
        if ($content === false) {
             throw new \RuntimeException("Failed to read file: " . $file);
        }
        $request->body()->add('file', new MultipartValue('file', $content, basename($file)));

        if ($caption) $request->body()->add('caption', $caption);

        return $this->connector()->send($request);
    }

    public function sendVideo(string $phone, string $video, ?string $caption = null)
    {
        $phone = $this->formatPhone($phone);
        $this->validatePreSending($phone);

        $request = new SendVideo();
        $request->body()->add('phone', $phone);

        if (filter_var($video, FILTER_VALIDATE_URL)) {
             $request->body()->add('video_url', $video);
        } else {
             if (!file_exists($video)) {
                 throw new \InvalidArgumentException("Video file not found: " . $video);
             }
             $content = file_get_contents($video);
             if ($content === false) {
                 throw new \RuntimeException("Failed to read video file: " . $video);
             }
             $request->body()->add('video', new MultipartValue('video', $content, basename($video)));
        }

        if ($caption) $request->body()->add('caption', $caption);
        $request->body()->add('view_once', 'false');

        return $this->connector()->send($request);
    }

    public function sendAudio(string $phone, string $audio)
    {
        $phone = $this->formatPhone($phone);
        $this->validatePreSending($phone);

        $request = new SendAudio();
        $request->body()->add('phone', $phone);

        if (filter_var($audio, FILTER_VALIDATE_URL)) {
             $request->body()->add('audio_url', $audio);
        } else {
             if (!file_exists($audio)) {
                 throw new \InvalidArgumentException("Audio file not found: " . $audio);
             }
             $content = file_get_contents($audio);
             if ($content === false) {
                 throw new \RuntimeException("Failed to read audio file: " . $audio);
             }
             $request->body()->add('audio', new MultipartValue('audio', $content, basename($audio)));
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
        $phone = $this->formatPhone($phone);
        $this->validatePreSending($phone);

        $request = new SendChatPresence();
        $body = [
            'phone' => $phone,
            'action' => $action,
        ];
        $request->body()->set($body);
        return $this->connector()->send($request);
    }
}
