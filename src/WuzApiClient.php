<?php

namespace Bayurifkialghifari\WuzApi;

use Bayurifkialghifari\WuzApi\Exceptions\WuzApiException;
use Bayurifkialghifari\WuzApi\Modules\AdminModule;
use Bayurifkialghifari\WuzApi\Modules\ChatModule;
use Bayurifkialghifari\WuzApi\Modules\GroupModule;
use Bayurifkialghifari\WuzApi\Modules\SessionModule;
use Bayurifkialghifari\WuzApi\Modules\UserModule;
use Bayurifkialghifari\WuzApi\Modules\WebhookModule;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class WuzApiClient
{
    public readonly SessionModule $session;

    public readonly ChatModule $chat;

    public readonly UserModule $user;

    public readonly GroupModule $group;

    public readonly AdminModule $admin;

    public readonly WebhookModule $webhook;

    public function __construct(
        protected ?string $baseUrl,
        protected ?string $token = null,
    ) {
        $this->session = new SessionModule($this);
        $this->chat = new ChatModule($this);
        $this->user = new UserModule($this);
        $this->group = new GroupModule($this);
        $this->admin = new AdminModule($this);
        $this->webhook = new WebhookModule($this);
    }

    /**
     * Build an HTTP pending request with auth headers.
     */
    public function http(?string $token = null): PendingRequest
    {
        $resolvedToken = $token ?? $this->token;

        if (! $resolvedToken) {
            throw new WuzApiException(
                'No authentication token provided. Set WUZAPI_TOKEN in your env or pass a token.',
                401
            );
        }

        return Http::baseUrl($this->baseUrl)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $resolvedToken,
                'Token' => $resolvedToken,
            ]);
    }

    /**
     * Execute an HTTP request and unwrap the WuzAPI response envelope.
     *
     * @throws WuzApiException
     */
    public function request(string $method, string $endpoint, array $data = [], ?string $token = null): mixed
    {
        try {
            $http = $this->http($token);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($endpoint, $data ?: null),
                'POST' => $http->post($endpoint, $data),
                'PUT' => $http->put($endpoint, $data),
                'DELETE' => $http->delete($endpoint, $data ?: null),
                default => throw new WuzApiException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json() ?? [];
                throw new WuzApiException(
                    $body['message'] ?? $body['error'] ?? 'WuzAPI request failed',
                    $body['code'] ?? $response->status(),
                    $body
                );
            }

            $body = $response->json();

            if (isset($body['success']) && $body['success'] === false) {
                throw new WuzApiException(
                    $body['error'] ?? 'API request failed',
                    $body['code'] ?? 0,
                    $body
                );
            }

            return $body['data'] ?? $body;
        } catch (RequestException $e) {
            throw new WuzApiException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function get(string $endpoint, array $query = [], ?string $token = null): mixed
    {
        return $this->request('GET', $endpoint, $query, $token);
    }

    public function post(string $endpoint, array $data = [], ?string $token = null): mixed
    {
        return $this->request('POST', $endpoint, $data, $token);
    }

    public function put(string $endpoint, array $data = [], ?string $token = null): mixed
    {
        return $this->request('PUT', $endpoint, $data, $token);
    }

    public function delete(string $endpoint, array $data = [], ?string $token = null): mixed
    {
        return $this->request('DELETE', $endpoint, $data, $token);
    }
}
