<?php

use Bayurifkialghifari\WuzApi\DTOs\Session\ConnectRequest;
use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->client = new WuzApiClient('http://localhost:8080', 'test-token');
});

it('connects to WhatsApp', function () {
    Http::fake([
        'http://localhost:8080/session/connect' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'details' => 'Connected',
                'events' => 'Message',
                'jid' => '1234@s.whatsapp.net',
                'webhook' => 'https://example.com/webhook',
            ],
        ]),
    ]);

    $request = new ConnectRequest(subscribe: ['Message'], immediate: false);
    $response = $this->client->session->connect($request);

    expect($response->jid)->toBe('1234@s.whatsapp.net')
        ->and($response->details)->toBe('Connected');
});

it('gets session status', function () {
    Http::fake([
        'http://localhost:8080/session/status' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'connected' => true,
                'loggedIn' => true,
                'jid' => '1234@s.whatsapp.net',
                'id' => 'user-id',
                'name' => 'Test User',
                'events' => ['Message'],
                'proxy_config' => [],
                'proxy_url' => '',
                'qrcode' => '',
                's3_config' => [],
                'token' => 'test-token',
                'webhook' => '',
            ],
        ]),
    ]);

    $status = $this->client->session->getStatus();

    expect($status->connected)->toBeTrue()
        ->and($status->jid)->toBe('1234@s.whatsapp.net');
});

it('gets QR code', function () {
    Http::fake([
        'http://localhost:8080/session/qr' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => ['QRCode' => 'data:image/png;base64,abc123'],
        ]),
    ]);

    $qr = $this->client->session->getQRCode();

    expect($qr->qrCode)->toBe('data:image/png;base64,abc123');
});

it('pairs phone', function () {
    Http::fake([
        'http://localhost:8080/session/pairphone' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => ['LinkingCode' => '1234-5678'],
        ]),
    ]);

    $response = $this->client->session->pairPhone('5491155554444');

    expect($response->linkingCode)->toBe('1234-5678');
});

it('disconnects session', function () {
    Http::fake([
        'http://localhost:8080/session/disconnect' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => ['Details' => 'Disconnected'],
        ]),
    ]);

    $response = $this->client->session->disconnect();

    expect($response)->toBeArray();
});
