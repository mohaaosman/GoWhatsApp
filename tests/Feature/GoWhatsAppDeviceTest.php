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
        // Checking a known number (from previous context, usually returns 200/exists)
        $exists = $device->numberExists('252614392674'); // Assuming this number is valid on WA
        
        // If live test, this might fail if number is invalid/banned, but checks the method runs
        // If it returns bool, we expect bool
        expect($exists)->toBeBool();
    } catch (\Exception $e) {
        $this->fail('Number check failed: ' . $e->getMessage());
    }
});
