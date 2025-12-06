# GoWhatsApp Laravel Package

A Laravel wrapper for [go-whatsapp-web-multidevice](https://github.com/aldinokemal/go-whatsapp-web-multidevice) using [Saloon](https://docs.saloon.dev/).

## Prerequisites

Before using this package, you must have the **go-whatsapp-web-multidevice** server running. This package interacts with its API.

### Setting up the Server

You can run the server locally using Docker or deploy it to a remote server.

**Run with Docker:**

```bash
docker run -d \
  --name go-whatsapp \
  -p 3000:3000 \
  -v $(pwd)/whatsapp_files:/usr/src/app/files \
  -e SECRET_KEY=your-secret-key \
  aldinokemal/go-whatsapp-web-multidevice
```

Or using **Docker Compose**:

```yaml
version: '3.9'
services:
  go-whatsapp:
    image: aldinokemal/go-whatsapp-web-multidevice
    ports:
      - "3000:3000"
    volumes:
      - ./whatsapp_files:/usr/src/app/files
    environment:
      - SECRET_KEY=your-secret-key
```

Once running, the API will be available at `http://localhost:3000` (or your server IP).

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

### Getting the Device Instance

The package simplifies device management by providing a helper to get the single active device instance. It automatically checks for an existing device in the database, fetches from the API, or creates one based on your config.

```php
use Zifala\GoWhatsApp\Models\GoWhatsAppDevice;

// Retrieve the singleton device instance
$device = GoWhatsAppDevice::getDevice();
```

### App Management

Manage the session and connection state.

```php
// List all active sessions/devices on the server
$devices = $device->devices();

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

> **Note**: Methods return `true` on success and throw a `RuntimeException` on failure (e.g., WhatsApp error, number not found).

```php
// Send Text
$device->sendMessage('628123456789', 'Hello from Laravel!');

// Send Text with Reply
$device->sendMessage('628123456789', 'Replying to you', 'message-id-to-reply');

// Send Image
$device->sendImage('628123456789', '/path/to/image.jpg', 'Cool Image');
// Or via URL
$device->sendImage('628123456789', 'https://example.com/image.jpg', 'Image from URL');

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

### Group Management

Create and manage groups.

```php
// Create Group
$device->createGroup('My Group Name', ['628123456789', '628987654321']);

// Join Group via Link
$device->joinGroup('https://chat.whatsapp.com/InviteLink...');

// Leave Group
$device->leaveGroup('123456789-123456@g.us');

// Get Group Info
$info = $device->groupInfo('123456789-123456@g.us');
```

### Account Management

Manage user account information.

```php
// Get User Info
$info = $device->userInfo('628123456789');

// Check if User exists on WhatsApp (Raw Response)
$response = $device->checkUser('628123456789');

// Check if Number Exists (Boolean Helper)
// Returns true if registered on WhatsApp, false otherwise.
$exists = $device->numberExists('628123456789'); 

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
