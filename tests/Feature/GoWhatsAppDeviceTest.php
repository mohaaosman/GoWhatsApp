<?php

use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;
use Zifala\GoWhatsApp\Models\GoWhatsAppLog;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;
use Zifala\GoWhatsApp\Requests\Send\SendMessage;

test('can create a device', function () {
    $device = GoWhatsAppDevice::create([
        'name' => 'Test Device',
        'base_url' => 'http://test.local',
        'username' => 'user',
        'password' => 'secret',
        'phone' => '123456',
    ]);

    expect($device)->toBeInstanceOf(GoWhatsAppDevice::class);
    expect($device->name)->toBe('Test Device');
});

test('can send message and log it', function () {
    // Enable logging
    config()->set('go-whatsapp.logging_enabled', true);

    $device = GoWhatsAppDevice::create([
        'name' => 'Test Device',
        'base_url' => 'http://test.local',
        'username' => 'user',
        'password' => 'secret',
    ]);

    // Mock Saloon
    Saloon::fake([
        SendMessage::class => MockResponse::make(['results' => ['id' => '123']], 200),
    ]);

    // Send Message
    $response = $device->sendMessage('1234567890', 'Hello World');

    expect($response->successful())->toBeTrue();

    // Check Saloon was called
    Saloon::assertSent(SendMessage::class);

    // Check Logs
    expect(GoWhatsAppLog::count())->toBe(1);
    $log = GoWhatsAppLog::first();
    expect($log->status)->toBe('MESSAGE SUCCESSFULLY SENT');
    
    // Payload is cast to array
    expect($log->payload)->toBeArray();
    expect($log->payload['response_body'])->toContain('results');
});
