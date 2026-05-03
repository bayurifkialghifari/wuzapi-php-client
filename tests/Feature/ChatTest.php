<?php

use Bayurifkialghifari\WuzApi\DTOs\Chat\ChatButton;
use Bayurifkialghifari\WuzApi\DTOs\Chat\ListItem;
use Bayurifkialghifari\WuzApi\DTOs\Chat\ListSection;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendButtonsRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendImageRequest;
use Bayurifkialghifari\WuzApi\DTOs\Chat\SendTextRequest;
use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->client = new WuzApiClient('http://localhost:8080', 'test-token');

    $this->fakeSendResponse = [
        'success' => true,
        'code' => 200,
        'data' => [
            'Details' => 'Sent',
            'Id' => 'msg-id-abc',
            'Timestamp' => '2024-01-01T00:00:00Z',
        ],
    ];
});

it('sends a text message', function () {
    Http::fake([
        'http://localhost:8080/chat/send/text' => Http::response($this->fakeSendResponse),
    ]);

    $request = new SendTextRequest(phone: '5491155554444', body: 'Hello World!');
    $response = $this->client->chat->sendText($request);

    expect($response->id)->toBe('msg-id-abc')
        ->and($response->details)->toBe('Sent');
});

it('sends an image message', function () {
    Http::fake([
        'http://localhost:8080/chat/send/image' => Http::response($this->fakeSendResponse),
    ]);

    $request = new SendImageRequest(
        phone: '5491155554444',
        image: 'data:image/jpeg;base64,/9j/4AAQ...',
        caption: 'Check this out!'
    );
    $response = $this->client->chat->sendImage($request);

    expect($response->id)->toBe('msg-id-abc');
});

it('sends a buttons message', function () {
    Http::fake([
        'http://localhost:8080/chat/send/buttons' => Http::response($this->fakeSendResponse),
    ]);

    $request = new SendButtonsRequest(
        phone: '5491155554444',
        body: 'Choose:',
        buttons: [
            new ChatButton(buttonId: 'yes', displayText: 'Yes'),
            new ChatButton(buttonId: 'no', displayText: 'No'),
        ]
    );
    $response = $this->client->chat->sendButtons($request);

    expect($response->id)->toBe('msg-id-abc');
});

it('sends a list message', function () {
    Http::fake([
        'http://localhost:8080/chat/send/list' => Http::response($this->fakeSendResponse),
    ]);

    $sections = [
        new ListSection('Main', [
            new ListItem('Option 1', 'opt1'),
            new ListItem('Option 2', 'opt2', 'Description'),
        ]),
    ];

    $response = $this->client->chat->sendList('5491155554444', 'View Menu', 'Select', 'Options', $sections);

    expect($response->id)->toBe('msg-id-abc');
});

it('sends a poll message', function () {
    Http::fake([
        'http://localhost:8080/chat/send/poll' => Http::response($this->fakeSendResponse),
    ]);

    $response = $this->client->chat->sendPoll('120362@g.us', 'Favorite?', ['Red', 'Blue', 'Green']);

    expect($response->id)->toBe('msg-id-abc');
});

it('deletes a message', function () {
    Http::fake([
        'http://localhost:8080/chat/delete' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => ['Details' => 'Deleted'],
        ]),
    ]);

    $result = $this->client->chat->deleteMessage('msg-id-abc');

    expect($result)->toBeArray();
});

it('gets chat history', function () {
    Http::fake([
        'http://localhost:8080/chat/history*' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                [
                    'chat_jid' => '5491@s.whatsapp.net',
                    'id' => 1,
                    'media_link' => '',
                    'message_id' => 'msg-1',
                    'message_type' => 'text',
                    'sender_jid' => '5491@s.whatsapp.net',
                    'text_content' => 'Hello',
                    'timestamp' => '2024-01-01T00:00:00Z',
                    'user_id' => 'user-1',
                ],
            ],
        ]),
    ]);

    $history = $this->client->chat->getChatHistory('5491@s.whatsapp.net', 50);

    expect($history)->toHaveCount(1)
        ->and($history[0]->messageType)->toBe('text');
});
