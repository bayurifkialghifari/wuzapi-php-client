<?php

namespace Bayurifkialghifari\WuzApi\Modules;

use Bayurifkialghifari\WuzApi\DTOs\Common\S3Config;
use Bayurifkialghifari\WuzApi\DTOs\Session\ConnectRequest;
use Bayurifkialghifari\WuzApi\DTOs\Session\ConnectResponse;
use Bayurifkialghifari\WuzApi\DTOs\Session\HmacConfigResponse;
use Bayurifkialghifari\WuzApi\DTOs\Session\PairPhoneResponse;
use Bayurifkialghifari\WuzApi\DTOs\Session\QRCodeResponse;
use Bayurifkialghifari\WuzApi\DTOs\Session\StatusResponse;
use Bayurifkialghifari\WuzApi\WuzApiClient;

class SessionModule
{
    public function __construct(protected WuzApiClient $client) {}

    /**
     * Connect to WhatsApp servers.
     */
    public function connect(ConnectRequest $request, ?string $token = null): ConnectResponse
    {
        $data = $this->client->post('/session/connect', $request->toArray(), $token);

        return ConnectResponse::fromArray((array) $data);
    }

    /**
     * Disconnect from WhatsApp (keeps session).
     */
    public function disconnect(?string $token = null): array
    {
        return (array) $this->client->post('/session/disconnect', [], $token);
    }

    /**
     * Logout from WhatsApp (destroys session).
     */
    public function logout(?string $token = null): array
    {
        return (array) $this->client->post('/session/logout', [], $token);
    }

    /**
     * Get session connection status.
     */
    public function getStatus(?string $token = null): StatusResponse
    {
        $data = $this->client->get('/session/status', [], $token);

        return StatusResponse::fromArray((array) $data);
    }

    /**
     * Get QR code for WhatsApp scanning.
     */
    public function getQRCode(?string $token = null): QRCodeResponse
    {
        $data = $this->client->get('/session/qr', [], $token);

        return QRCodeResponse::fromArray((array) $data);
    }

    /**
     * Pair phone using phone number (generates verification code).
     */
    public function pairPhone(string $phone, ?string $token = null): PairPhoneResponse
    {
        $data = $this->client->post('/session/pairphone', ['Phone' => $phone], $token);

        return PairPhoneResponse::fromArray((array) $data);
    }

    /**
     * Request history sync from WhatsApp servers.
     */
    public function requestHistory(?string $token = null): array
    {
        return (array) $this->client->get('/session/history', [], $token);
    }

    /**
     * Set history count (use 0 to disable).
     */
    public function setHistoryCount(int $history, ?string $token = null): array
    {
        return (array) $this->client->post('/session/history', ['history' => $history], $token);
    }

    /**
     * Configure proxy settings.
     */
    public function setProxy(string $proxyUrl, bool $enable = true, ?string $token = null): array
    {
        return (array) $this->client->post('/session/proxy', [
            'proxy_url' => $proxyUrl,
            'enable' => $enable,
        ], $token);
    }

    /**
     * Configure S3 storage.
     */
    public function configureS3(S3Config $config, ?string $token = null): array
    {
        return (array) $this->client->post('/session/s3/config', $config->toArray(), $token);
    }

    /**
     * Get S3 configuration.
     */
    public function getS3Config(?string $token = null): array
    {
        return (array) $this->client->get('/session/s3/config', [], $token);
    }

    /**
     * Test S3 connection.
     */
    public function testS3(?string $token = null): array
    {
        return (array) $this->client->post('/session/s3/test', [], $token);
    }

    /**
     * Delete S3 configuration.
     */
    public function deleteS3Config(?string $token = null): array
    {
        return (array) $this->client->delete('/session/s3/config', [], $token);
    }

    /**
     * Configure HMAC key for webhook signing (minimum 32 characters).
     */
    public function configureHmac(string $hmacKey, ?string $token = null): HmacConfigResponse
    {
        $data = $this->client->post('/session/hmac/config', ['hmac_key' => $hmacKey], $token);

        return HmacConfigResponse::fromArray((array) $data);
    }

    /**
     * Get HMAC configuration status.
     */
    public function getHmacConfig(?string $token = null): HmacConfigResponse
    {
        $data = $this->client->get('/session/hmac/config', [], $token);

        return HmacConfigResponse::fromArray((array) $data);
    }

    /**
     * Delete HMAC configuration.
     */
    public function deleteHmacConfig(?string $token = null): array
    {
        return (array) $this->client->delete('/session/hmac/config', [], $token);
    }
}
