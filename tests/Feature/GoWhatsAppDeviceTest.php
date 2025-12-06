<?php

use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;
use Zifala\GoWhatsApp\Models\GoWhatsAppLog;

beforeEach(function () {
    config()->set('go-whatsapp.logging_enabled', true);
});

test('can get singleton device', function () {
    // Ensure clean state
    GoWhatsAppDevice::truncate();
    
    // Should create from config if no API or DB
    $device = GoWhatsAppDevice::getDevice();
    
    expect($device)->toBeInstanceOf(GoWhatsAppDevice::class);
    expect(GoWhatsAppDevice::count())->toBe(1);
    
    // Calling again should return same instance (from DB)
    $device2 = GoWhatsAppDevice::getDevice();
    expect($device2->id)->toBe($device->id);
    expect(GoWhatsAppDevice::count())->toBe(1);
});

test('number exists check', function () {
    $device = GoWhatsAppDevice::getDevice();

    try {
        // Checking a known number
        $exists = $device->numberExists('252614392674'); 
        
        expect($exists)->toBeBool();
    } catch (\Exception $e) {
        // If API fails completely, failing test is appropriate for "live" mode
        $this->fail('Number check failed: ' . $e->getMessage());
    }
});

test('send message validates state', function () {
    $device = GoWhatsAppDevice::getDevice();
    
    try {
        // Sending to a valid number should pass validation and send
        $response = $device->sendMessage('252614392674', 'Hello Simple!');
        
        // We expect 200 or 201
        expect($response->status())->toBeIn([200, 201]);
    } catch (\Exception $e) {
        $this->fail('Message send failed: ' . $e->getMessage());
    }
});

test('can create group via trait', function () {
    $device = GoWhatsAppDevice::getDevice();
    
    // We won't actually create a group in test to avoid spamming, but we check if method exists
    expect(method_exists($device, 'createGroup'))->toBeTrue();
    
    // Optional: Call it if needed
    // $response = $device->createGroup('Test Group', ['252614392674']);
    // expect($response->status())->toBeIn([200, 201]);
});
