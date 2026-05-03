<?php

use Bayurifkialghifari\WuzApi\Exceptions\WuzApiException;
use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->client = new WuzApiClient('http://localhost:8080', 'test-token');
});

it('resolves WuzApiClient from the container', function () {
    $client = app(WuzApiClient::class);

    expect($client)->toBeInstanceOf(WuzApiClient::class);
});

it('resolves WuzApiClient via facade accessor', function () {
    $client = app('wuzapi');

    expect($client)->toBeInstanceOf(WuzApiClient::class);
});

it('throws WuzApiException when token is missing', function () {
    $client = new WuzApiClient('http://localhost:8080'); // no token

    expect(fn () => $client->get('/session/status'))->toThrow(WuzApiException::class);
});

it('throws WuzApiException on API failure response', function () {
    Http::fake([
        'http://localhost:8080/session/status' => Http::response([
            'success' => false,
            'code' => 401,
            'error' => 'Unauthorized',
        ], 401),
    ]);

    expect(fn () => $this->client->get('/session/status'))->toThrow(WuzApiException::class);
});

it('sends Authorization header with token', function () {
    Http::fake([
        'http://localhost:8080/session/status' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [],
        ]),
    ]);

    $this->client->get('/session/status');

    Http::assertSent(function ($request) {
        return $request->hasHeader('Authorization', 'test-token');
    });
});
