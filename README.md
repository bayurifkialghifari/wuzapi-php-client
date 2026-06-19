# WuzAPI PHP Client for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bayurifkialghifari/wuzapi-php-client.svg?style=flat-square)](https://packagist.org/packages/bayurifkialghifari/wuzapi-php-client)
[![Tests](https://img.shields.io/github/actions/workflow/status/bayurifkialghifari/wuzapi-php-client/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/bayurifkialghifari/wuzapi-php-client/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/bayurifkialghifari/wuzapi-php-client.svg?style=flat-square)](https://packagist.org/packages/bayurifkialghifari/wuzapi-php-client)

A Laravel PHP client library for the [WuzAPI WhatsApp API](https://github.com/asternic/wuzapi). Provides a clean, modular interface to interact with WhatsApp through your WuzAPI server instance.

## Features

- 🏗️ **Modular Architecture** — Organized by functionality: `session`, `chat`, `user`, `group`, `admin`, `webhook`
- 📦 **PHP DTOs** — Fully typed request/response objects for all API endpoints
- 🔗 **Laravel Integration** — Service provider, facade, and config file included
- ⚙️ **Configurable** — Set `base_url` and `token` via `.env` or config

## Requirements

- PHP >= 8.2
- Laravel / `illuminate/support` >= 12.0

## Installation

```bash
composer require bayurifkialghifari/wuzapi-php-client
```

Publish the config file:

```bash
php artisan vendor:publish --tag="wuzapi-config"
```

## Configuration

Add to your `.env`:

```env
WUZAPI_BASE_URL=http://localhost:8080
WUZAPI_TOKEN=your-admin-token
```

Published config (`config/wuzapi.php`):

```php
return [
    'base_url' => env('WUZAPI_BASE_URL', 'http://localhost:8080'),
    'token'    => env('WUZAPI_TOKEN'),
];
```

## Quick Start

```php
use Bayurifkialghifari\WuzApi\Facades\WuzApi;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendTextRequest;
use Bayurifkialghifari\WuzApi\DTOs\Session\ConnectRequest;

// Connect to WhatsApp
WuzApi::session->connect(new ConnectRequest(
    subscribe: ['Message', 'ReadReceipt'],
));

// Send a text message
$response = WuzApi::chat->sendText(new SendTextRequest(
    phone: '628123456789',
    body: 'Hello from Laravel! 👋',
));

echo $response->id; // message ID
```

Or resolve from the container directly:

```php
use Bayurifkialghifari\WuzApi\WuzApiClient;

$client = app(WuzApiClient::class);
$client->chat->sendText(new SendTextRequest(phone: '628xx', body: 'Hi!'));
```

---

## API Reference

### 📱 Session

```php
use Bayurifkialghifari\WuzApi\DTOs\Session\ConnectRequest;

// Connect
WuzApi::session->connect(new ConnectRequest(subscribe: ['Message', 'ReadReceipt']));

// Get status
$status = WuzApi::session->getStatus();
echo $status->connected; // bool
echo $status->jid;       // WhatsApp JID

// QR Code
$qr = WuzApi::session->getQRCode();
echo $qr->qrCode; // base64 QR string

// Pair by phone number
$pair = WuzApi::session->pairPhone('628123456789');
echo $pair->linkingCode; // e.g. "1234-5678"

// Disconnect / Logout
WuzApi::session->disconnect();
WuzApi::session->logout();

// History count
WuzApi::session->setHistoryCount(100); // 0 to disable

// Proxy
WuzApi::session->setProxy('socks5://user:pass@proxy:1080', enable: true);

// HMAC webhook signing
WuzApi::session->configureHmac('your_hmac_key_min_32_characters_long');
WuzApi::session->deleteHmacConfig();
```

### 💬 Chat

```php
use Bayurifkialghifari\WuzApi\DTOs\Chat\{
    SendTextRequest, SendImageRequest, SendAudioRequest,
    SendVideoRequest, SendDocumentRequest, SendStickerRequest,
    SendLocationRequest, SendContactRequest,
    SendButtonsRequest, ChatButton,
    SendTemplateRequest, TemplateButton,
    SendPollRequest, ReactRequest, MarkReadRequest,
    ListSection, ListItem, DownloadMediaRequest,
};

// Text
WuzApi::chat->sendText(new SendTextRequest(phone: '628xx', body: 'Hello!'));

// Image
WuzApi::chat->sendImage(new SendImageRequest(
    phone: '628xx',
    image: 'data:image/jpeg;base64,/9j/4AAQ...',
    caption: 'Check this out!',
));

// Audio / Video / Document / Sticker
WuzApi::chat->sendAudio(new SendAudioRequest(phone: '628xx', audio: 'data:audio/ogg;base64,...'));
WuzApi::chat->sendVideo(new SendVideoRequest(phone: '628xx', video: 'data:video/mp4;base64,...'));
WuzApi::chat->sendDocument(new SendDocumentRequest(phone: '628xx', document: '...', fileName: 'file.pdf'));
WuzApi::chat->sendSticker(new SendStickerRequest(phone: '628xx', sticker: 'data:image/webp;base64,...'));

// Location & Contact
WuzApi::chat->sendLocation(new SendLocationRequest(phone: '628xx', latitude: -6.2, longitude: 106.8, name: 'Jakarta'));
WuzApi::chat->sendContact(new SendContactRequest(phone: '628xx', name: 'John', vcard: 'BEGIN:VCARD...'));

// Buttons
WuzApi::chat->sendButtons(new SendButtonsRequest(
    phone: '628xx',
    body: 'Choose:',
    buttons: [
        new ChatButton(buttonId: 'yes', displayText: 'Yes'),
        new ChatButton(buttonId: 'no',  displayText: 'No'),
    ],
));

// List
WuzApi::chat->sendList('628xx', 'View Menu', 'Pick one', 'Options', [
    new ListSection('Main', [
        new ListItem('Pizza', 'pizza', 'Delicious'),
        new ListItem('Burger', 'burger'),
    ]),
]);

// Poll (groups only)
WuzApi::chat->sendPoll('120362@g.us', 'Favorite color?', ['Red', 'Blue', 'Green']);

// React
WuzApi::chat->react(new ReactRequest(phone: '628xx', body: '❤️', id: 'msg-id'));

// Mark read
WuzApi::chat->markRead(new MarkReadRequest(ids: ['msg-1', 'msg-2'], chat: '628xx@s.whatsapp.net'));

// Edit / Delete
WuzApi::chat->editMessage('msg-id', '628xx', 'Updated text');
WuzApi::chat->deleteMessage('msg-id', '628xx');

// Archive
WuzApi::chat->archiveChat('628xx@s.whatsapp.net', archive: true);

// Chat history
$messages = WuzApi::chat->getChatHistory('628xx@s.whatsapp.net', limit: 50);

// Download media
$media = WuzApi::chat->downloadImage(new DownloadMediaRequest(
    url: 'https://mmg.whatsapp.net/...',
    directPath: '/path',
    mediaKey: 'key',
    mimetype: 'image/jpeg',
    fileEncSha256: 'hash',
    fileSha256: 'hash',
    fileLength: 2048,
));
echo $media->data; // base64
```

### 👤 User

```php
// Check if numbers are on WhatsApp
$checks = WuzApi::user->check(['628123456789']);
echo $checks[0]->isInWhatsapp; // bool

// Get user info
$info = WuzApi::user->getInfo(['628123456789']);

// Avatar
$avatar = WuzApi::user->getAvatar('628123456789', preview: true);
echo $avatar->url;

// Contacts
$contacts = WuzApi::user->getContacts();

// Presence
WuzApi::user->sendPresence('available'); // or 'unavailable'

// LID
$lid = WuzApi::user->getLid('628123456789');
echo $lid->lid;
```

### 👥 Group

```php
// List groups
$groups = WuzApi::group->list();

// Create
$group = WuzApi::group->create('My Group', ['628111', '628222']);
echo $group->jid;

// Info
$info = WuzApi::group->getInfo('120362@g.us');

// Participants
WuzApi::group->updateParticipants('120362@g.us', 'add',    ['628333']);
WuzApi::group->updateParticipants('120362@g.us', 'remove', ['628333']);
WuzApi::group->updateParticipants('120362@g.us', 'promote', ['628333']);
WuzApi::group->updateParticipants('120362@g.us', 'demote',  ['628333']);

// Settings
WuzApi::group->setName('120362@g.us', 'New Name');
WuzApi::group->setTopic('120362@g.us', 'New description');
WuzApi::group->setAnnounce('120362@g.us', true);   // only admins can send
WuzApi::group->setLocked('120362@g.us', true);     // only admins can edit info
WuzApi::group->setEphemeral('120362@g.us', '7d');  // '24h' | '7d' | '90d' | 'off'

// Photo
WuzApi::group->setPhoto('120362@g.us', 'data:image/jpeg;base64,...');
WuzApi::group->removePhoto('120362@g.us');

// Invite
$link = WuzApi::group->getInviteLink('120362@g.us');
WuzApi::group->join('https://chat.whatsapp.com/XXXX');
WuzApi::group->leave('120362@g.us');
```

### 🔗 Webhook

```php
use Bayurifkialghifari\WuzApi\DTOs\Webhook\WebhookEventType;
use Bayurifkialghifari\WuzApi\Modules\WebhookModule;

// Set webhook
WuzApi::webhook->setWebhook('https://example.com/webhook', [
    WebhookEventType::MESSAGE,
    WebhookEventType::READ_RECEIPT,
    WebhookEventType::CONNECTED,
]);

// Get config
$config = WuzApi::webhook->getWebhook();
echo $config->webhook;   // URL
echo $config->subscribe; // array of subscribed events

// Update
WuzApi::webhook->updateWebhook(
    webhookUrl: 'https://new-url.com/webhook',
    events: [WebhookEventType::MESSAGE],
    active: true,
);

// Delete
WuzApi::webhook->deleteWebhook();

// All available events
$events = WebhookModule::getAvailableEvents(); // array of strings
```

### 👨‍💼 Admin (requires admin token)

```php
use Bayurifkialghifari\WuzApi\DTOs\Admin\{CreateUserRequest, UpdateUserRequest};

// List users
$users = WuzApi::admin->listUsers(token: 'admin-token');

// Get user
$user = WuzApi::admin->getUser('user-id', token: 'admin-token');

// Create user
$new = WuzApi::admin->addUser(new CreateUserRequest(
    name: 'John Doe',
    token: 'user-token-123',
    webhook: 'https://example.com/hook',
    events: 'Message,ReadReceipt',
    history: 20,
), token: 'admin-token');

// Update user
WuzApi::admin->updateUser('user-id', new UpdateUserRequest(
    name: 'Updated Name',
    history: 100,
), token: 'admin-token');

// Delete user
WuzApi::admin->deleteUser('user-id', token: 'admin-token');
WuzApi::admin->deleteUserComplete('user-id', token: 'admin-token'); // full deletion
```

---

## Per-Request Token Override

Each method accepts an optional `$token` parameter to override the configured token:

```php
$client->chat->sendText(new SendTextRequest(phone: '628xx', body: 'Hi'), token: 'other-user-token');
```

---

## WebhookEventType Enum

All 45 WuzAPI webhook events are available as a PHP backed enum:

```php
use Bayurifkialghifari\WuzApi\DTOs\Webhook\WebhookEventType;

WebhookEventType::MESSAGE->value;        // 'Message'
WebhookEventType::CONNECTED->value;      // 'Connected'
WebhookEventType::HISTORY_SYNC->value;   // 'HistorySync'
WebhookEventType::ALL->value;            // 'All'
```

---

## Testing

```bash
composer test
```

The test suite uses `Http::fake()` — no real WuzAPI server needed.

---

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for recent changes.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
