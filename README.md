# GoWhatsApp Laravel Package

A Laravel wrapper for [go-whatsapp-web-multidevice](https://github.com/aldinokemal/go-whatsapp-web-multidevice) using [Saloon](https://docs.saloon.dev/).

## Installation

```bash
composer require zifala/go-whatsapp-laravel
```

## Configuration

Publish the configuration file:

```bash
php artisan vendor:publish --tag=go-whatsapp-config
```

Set your environment variables in `.env`:

```env
GO_WHATSAPP_BASE_URL=http://localhost:3000
GO_WHATSAPP_API_KEY=your-api-key-if-any
```

## Usage

### Connector

```php
use Zifala\GoWhatsApp\GoWhatsAppConnector;

$connector = new GoWhatsAppConnector();
```

### Authentication

#### Login with Code

```php
use Zifala\GoWhatsApp\Requests\Auth\LoginWithCodeRequest;

$request = new LoginWithCodeRequest('628123456789');
$response = $connector->send($request);
```

#### Get QR Code

```php
use Zifala\GoWhatsApp\Requests\Auth\GetQrCodeRequest;

$request = new GetQrCodeRequest();
$response = $connector->send($request);
```

### Sending Messages

#### Send Text

```php
use Zifala\GoWhatsApp\Requests\Message\SendTextRequest;

$request = new SendTextRequest('628123456789', 'Hello from Laravel!');
$response = $connector->send($request);
```

