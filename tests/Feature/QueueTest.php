<?php

use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;
use Zifala\GoWhatsApp\Jobs\ProcessSendMessage;
use Illuminate\Support\Facades\Queue;

beforeEach(function () {
    // Ensure clean state
    GoWhatsAppDevice::truncate();
    
    // Create a dummy device to avoid API calls during getDevice()
    GoWhatsAppDevice::create([
        'name' => 'Test Device',
        'base_url' => 'http://example.com',
        'username' => 'test',
        'password' => 'test',
        'phone' => '1234567890',
        'status' => 'connected'
    ]);
});

test('send message dispatches job when queue enabled', function () {
    config()->set('go-whatsapp.queue_enabled', true);
    Queue::fake();
    
    $device = GoWhatsAppDevice::getDevice();

    $result = $device->sendMessage('1234567890', 'Test Message');

    expect($result)->toBeTrue();

    Queue::assertPushed(ProcessSendMessage::class, function ($job) {
        return $job->phone === '1234567890' && $job->message === 'Test Message';
    });
});

test('send message does not dispatch job when queue disabled', function () {
    config()->set('go-whatsapp.queue_enabled', false);
    Queue::fake();
    
    // We need to mock the HTTP call since it will try to send
    // But since we don't want to rely on Saloon mock if we want to just check queue,
    // we can rely on the fact that without queue, it throws exception if connection fails.
    // However, checking Queue::assertNotPushed is safer.
    
    // We expect it to fail due to network/fake URL, but verify queue wasn't touched.
    try {
        GoWhatsAppDevice::getDevice()->sendMessage('1234567890', 'Test Message');
    } catch (\Exception $e) {
        // Expected failure
    }

    Queue::assertNotPushed(ProcessSendMessage::class);
});

