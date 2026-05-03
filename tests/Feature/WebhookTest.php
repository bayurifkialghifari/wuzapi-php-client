<?php

use Bayurifkialghifari\WuzApi\DTOs\Webhook\WebhookEventType;
use Bayurifkialghifari\WuzApi\Modules\WebhookModule;
use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->client = new WuzApiClient('http://localhost:8080', 'test-token');
});

it('sets a webhook', function () {
    Http::fake([
        'http://localhost:8080/webhook' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'WebhookURL' => 'https://example.com/hook',
                'Events' => ['Message', 'ReadReceipt'],
            ],
        ]),
    ]);

    $response = $this->client->webhook->setWebhook(
        'https://example.com/hook',
        [WebhookEventType::MESSAGE, WebhookEventType::READ_RECEIPT]
    );

    expect($response->webhookUrl)->toBe('https://example.com/hook')
        ->and($response->events)->toContain('Message');
});

it('gets webhook configuration', function () {
    Http::fake([
        'http://localhost:8080/webhook' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'subscribe' => ['Message'],
                'webhook' => 'https://example.com/hook',
            ],
        ]),
    ]);

    $config = $this->client->webhook->getWebhook();

    expect($config->webhook)->toBe('https://example.com/hook')
        ->and($config->subscribe)->toContain('Message');
});

it('deletes a webhook', function () {
    Http::fake([
        'http://localhost:8080/webhook' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => ['Details' => 'Deleted'],
        ]),
    ]);

    $result = $this->client->webhook->deleteWebhook();

    expect($result)->toBeArray();
});

it('returns all available webhook event types', function () {
    $events = WebhookModule::getAvailableEvents();

    expect($events)->toContain('Message')
        ->toContain('Connected')
        ->toContain('All');
});

it('webhook event type enum has correct values', function () {
    expect(WebhookEventType::MESSAGE->value)->toBe('Message')
        ->and(WebhookEventType::CONNECTED->value)->toBe('Connected')
        ->and(WebhookEventType::ALL->value)->toBe('All');
});
