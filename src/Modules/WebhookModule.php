<?php

namespace Bayurifkialghifari\WuzApi\Modules;

use Bayurifkialghifari\WuzApi\DTOs\Webhook\GetWebhookResponse;
use Bayurifkialghifari\WuzApi\DTOs\Webhook\SetWebhookRequest;
use Bayurifkialghifari\WuzApi\DTOs\Webhook\SetWebhookResponse;
use Bayurifkialghifari\WuzApi\DTOs\Webhook\UpdateWebhookRequest;
use Bayurifkialghifari\WuzApi\DTOs\Webhook\WebhookEventType;
use Bayurifkialghifari\WuzApi\WuzApiClient;

class WebhookModule
{
    public function __construct(protected WuzApiClient $client) {}

    /**
     * Set webhook URL and events to subscribe to.
     *
     * @param  string[]|WebhookEventType[]  $events
     */
    public function setWebhook(string $webhookUrl, array $events = ['All'], ?string $token = null): SetWebhookResponse
    {
        $request = new SetWebhookRequest($webhookUrl, $events);
        $data = $this->client->post('/webhook', $request->toArray(), $token);

        return SetWebhookResponse::fromArray((array) $data);
    }

    /**
     * Get current webhook configuration.
     */
    public function getWebhook(?string $token = null): GetWebhookResponse
    {
        $data = $this->client->get('/webhook', [], $token);

        return GetWebhookResponse::fromArray((array) $data);
    }

    /**
     * Update webhook URL, events, and activation status.
     *
     * @param  string[]|WebhookEventType[]|null  $events
     */
    public function updateWebhook(
        ?string $webhookUrl = null,
        ?array $events = null,
        ?bool $active = null,
        ?string $token = null
    ): array {
        $request = new UpdateWebhookRequest($webhookUrl, $events, $active);

        return (array) $this->client->put('/webhook', $request->toArray(), $token);
    }

    /**
     * Delete webhook configuration.
     */
    public function deleteWebhook(?string $token = null): array
    {
        return (array) $this->client->delete('/webhook', [], $token);
    }

    /**
     * Get all available webhook event type values.
     *
     * @return string[]
     */
    public static function getAvailableEvents(): array
    {
        return WebhookEventType::values();
    }
}
