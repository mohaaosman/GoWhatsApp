# GoWhatsApp Laravel Package

A Laravel wrapper for [go-whatsapp-web-multidevice](https://github.com/aldinokemal/go-whatsapp-web-multidevice) using [Saloon](https://docs.saloon.dev/).

## Installation

You can install the package via composer:

```bash
composer require zifala/go-whatsapp-laravel
```

## Configuration

Publish the configuration file and migrations:

```bash
php artisan vendor:publish --tag="go-whatsapp-config"
php artisan vendor:publish --tag="go-whatsapp-migrations"
```

Run migrations to create the `go_whatsapp_devices` and `go_whatsapp_logs` tables:

```bash
php artisan migrate
```

Set your global defaults in `.env` (optional, used if no device-specific config is provided):

```env
GO_WHATSAPP_BASE_URL=http://localhost:3000
GO_WHATSAPP_USERNAME=your-username
GO_WHATSAPP_PASSWORD=your-password
GO_WHATSAPP_LOGGING_ENABLED=true
```

## Usage

### Managing Devices

The package uses the `GoWhatsAppDevice` model to manage connections. You can create a device record in your database:

```php
use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;

$device = GoWhatsAppDevice::create([
    'name' => 'My Main Device',
    'base_url' => 'http://localhost:3000',
    'username' => 'myuser',
    'password' => 'mypassword',
    'phone' => '628123456789', // Optional, for reference
]);
```

### App Management

Manage the session and connection state.

```php
// Login with code
$device->loginWithCode('628123456789');

// Login (QR Code flow usually initiated here if supported by API logic)
$device->login();

// Logout
$device->logout();

// Reconnect
$device->reconnect();
```

### Sending Messages

Send various types of messages easily.

```php
// Send Text
$device->sendMessage('628123456789', 'Hello from Laravel!');

// Send Text with Reply
$device->sendMessage('628123456789', 'Replying to you', 'message-id-to-reply');

// Send Image
$device->sendImage('628123456789', '/path/to/image.jpg', 'Cool Image');

// Send File
$device->sendFile('628123456789', '/path/to/document.pdf', 'Here is the doc');

// Send Video
$device->sendVideo('628123456789', '/path/to/video.mp4', 'Check this out');

// Send Audio
$device->sendAudio('628123456789', '/path/to/audio.mp3');

// Send Presence
$device->sendPresence('available'); // or 'unavailable'

// Send Chat Presence (Typing)
$device->sendChatPresence('628123456789', 'start'); // 'start' or 'stop'
```

### Account Management

Manage user account information.

```php
// Get User Info
$info = $device->userInfo('628123456789');

// Check if User exists on WhatsApp
$exists = $device->checkUser('628123456789');

// Get Avatar
$avatar = $device->avatar('628123456789');

// Change Avatar
$device->changeAvatar('/path/to/new/avatar.jpg');
```

### Chat Management

Interact with chats and messages.

```php
// Get Chat List
$chats = $device->chatList(limit: 10, search: 'John');

// Get Messages from a Chat
$messages = $device->chatMessages('628123456789@s.whatsapp.net', limit: 20);
```

### Logging

If logging is enabled in the config, all requests and statuses are logged to the `go_whatsapp_logs` table.

### Direct Connector Usage

If you need to access the underlying Saloon connector directly:

```php
use Zifala\GoWhatsApp\GoWhatsAppConnector;

$connector = new GoWhatsAppConnector('http://localhost:3000', 'username', 'password');

// Use generated resources directly
$response = $connector->sending()->sendMessage();
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
