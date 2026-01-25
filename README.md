# Telegram Bot PHP SDK

Unofficial Telegram Bot API SDK for PHP 8.1+.

## Telegram Bot API Version

This SDK tracks **Bot API 9.3** (released December 31, 2025).

- Changelog: https://core.telegram.org/bots/api-changelog
- Local API reference: `doc/telegram-bot-api.md`

## Requirements

- PHP 8.1+

## Install

```bash
composer require rarepixel-studio/telegram-bot
```

## Initialize the API

### Using a token
```php
<?php

require __DIR__.'/vendor/autoload.php';

use Telegram\Bot\Api;

$api = new Api('YOUR_BOT_TOKEN');
```

### Using `TELEGRAM_BOT_TOKEN`
```php
use Telegram\Bot\Api;

$api = new Api(); // reads TELEGRAM_BOT_TOKEN
```

### With a custom HTTP client
```php
use GuzzleHttp\Client as GuzzleClient;
use Telegram\Bot\Api;
use Telegram\Bot\HttpClients\GuzzleHttpClient;

$httpClient = new GuzzleHttpClient(new GuzzleClient([
    'timeout' => 30,
]));

$api = new Api('YOUR_BOT_TOKEN', false, $httpClient);
```

### Enable async mode at construction
```php
$api = new Api('YOUR_BOT_TOKEN', true);
```

## Calling Telegram Methods

### Array parameters (simple and direct)
```php
$message = $api->sendMessage([
    'chat_id' => 123456789,
    'text' => 'Hello from the bot!',
]);
```

### Typed request objects
```php
use Telegram\Bot\Requests\SendMessageRequest;

$request = (new SendMessageRequest(123456789, 'Hello from a request'))
    ->setParseMode('HTML');

$message = $api->sendMessage($request);
```

### Generic request handling
```php
use Telegram\Bot\Requests\SendMessageRequest;

$request = new SendMessageRequest(123456789, 'Handled via handleRequest');

$message = $api->handleRequest($request);
```

### Async requests
Enable async mode and methods return a `Closure`. Call it to resolve the response.

```php
$api->setAsyncRequest(true);

$pending = $api->sendMessage([
    'chat_id' => 123456789,
    'text' => 'Async message',
]);

$message = $pending(); // resolves and returns Message
```

You can also queue requests and wait later:

```php
$api->setAsyncRequest(true);
$api->sendMessage(['chat_id' => 1, 'text' => 'A']);
$api->sendMessage(['chat_id' => 2, 'text' => 'B']);

$responses = $api->asyncWait();
```

## Method Examples

### File uploads
Many methods accept a local file path, URL, stream, or `InputFile` instance.

```php
use Telegram\Bot\FileUpload\InputFile;

$photo = new InputFile(__DIR__.'/cat.jpg');

$api->sendPhoto([
    'chat_id' => 123456789,
    'photo' => $photo,
    'caption' => 'Cat!',
]);
```

### Media groups (attachments)
`sendMediaGroup` accepts an array of `InputMedia` objects. Local files are attached
automatically by the SDK.

```php
use Telegram\Bot\Objects\InputMedia;

$media = [
    new InputMedia(['type' => 'photo', 'media' => __DIR__.'/photo-1.jpg']),
    new InputMedia(['type' => 'photo', 'media' => __DIR__.'/photo-2.jpg']),
    new InputMedia(['type' => 'photo', 'media' => 'https://example.com/photo-3.jpg']),
];

$messages = $api->sendMediaGroup([
    'chat_id' => 123456789,
    'media' => $media,
]);
```

### Webhooks
Setting a webhook requires a valid HTTPS URL. Certificate uploads are supported.

```php
$api->setWebhook([
    'url' => 'https://example.com/telegram/webhook',
    'certificate' => __DIR__.'/public.pem', // optional
]);
```

Handling webhook updates:

```php
$update = $api->getWebhookUpdate();
// or
$updates = $api->getWebhookUpdates();
```

### Inline queries
`answerInlineQuery` automatically JSON-encodes the `results` array when needed.

```php
$api->answerInlineQuery([
    'inline_query_id' => '12345',
    'results' => [
        [
            'type' => 'article',
            'id' => '1',
            'title' => 'Example',
            'input_message_content' => [
                'message_text' => 'Hello from inline query',
            ],
        ],
    ],
]);
```

### Inline keyboards (using objects)
Build `InlineKeyboardMarkup` and `InlineKeyboardButton` objects and pass them as `reply_markup`.

```php
use Telegram\Bot\Objects\InlineKeyboardButton;
use Telegram\Bot\Objects\InlineKeyboardMarkup;

$keyboard = new InlineKeyboardMarkup([
    [
        new InlineKeyboardButton(['text' => 'Open Site', 'url' => 'https://example.com']),
        new InlineKeyboardButton(['text' => 'Ping', 'callback_data' => 'ping']),
    ],
]);

$api->sendMessage([
    'chat_id' => 123456789,
    'text' => 'Choose an option:',
    'reply_markup' => $keyboard,
]);
```

### Request objects and JSON encoding
When you use request objects, the SDK JSON-encodes only the fields that Telegram documents as "JSON-serialized".
This prevents missing keyboards, entities, or media options in form-encoded requests.

```php
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Objects\InlineKeyboardButton;
use Telegram\Bot\Objects\InlineKeyboardMarkup;

$button = InlineKeyboardButton::make('Open')->withUrl('https://example.com');
$markup = InlineKeyboardMarkup::make([[$button]]);

$request = new SendMessageRequest(123456789, 'Hello');
$request->setReplyMarkup($markup);

// Request objects handle JSON encoding for reply_markup and other JSON fields.
$api->sendMessage($request);
```

If you pass a plain array to an API method, you must JSON-encode fields that Telegram marks
as "JSON-serialized" in the official docs (for example: `reply_markup`, `options`, `entities`).

```php
$api->sendMessage([
    'chat_id' => 123456789,
    'text' => 'Hello',
    'reply_markup' => json_encode([
        'inline_keyboard' => [
            [[
                'text' => 'Open',
                'url' => 'https://example.com',
            ]],
        ],
    ]),
]);
```

For webhook responses, use `toWebhookPayload()` to keep nested fields as arrays for an
`application/json` response. Do not pre-encode those fields.

```php
return response()->json($request->toWebhookPayload());
```

### Mini App initData validation
Validate `Telegram.WebApp.initData` on your backend before trusting the payload.

```php
use Telegram\Bot\WebAppInitDataValidator;

$isValid = WebAppInitDataValidator::isValid(
    $initData,
    'YOUR_BOT_TOKEN',
    86400 // optional max age in seconds; null disables time check
);
```

## Error Handling

All SDK exceptions inherit from `TelegramSDKException`, so you can catch once or
handle specific types:

```php
use Telegram\Bot\Exceptions\TelegramSDKException;

try {
    $api->sendMessage(['chat_id' => 1, 'text' => 'Hello']);
} catch (TelegramSDKException $e) {
    // handle errors
}
```

## Documentation

The SDK maps directly to the official Telegram Bot API.

- Telegram API reference: `doc/telegram-bot-api.md`
- Official API docs: https://core.telegram.org/bots/api