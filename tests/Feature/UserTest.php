<?php

use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->client = new WuzApiClient('http://localhost:8080', 'test-token');
});

it('checks if numbers are WhatsApp users', function () {
    Http::fake([
        'http://localhost:8080/user/check' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'Users' => [
                    [
                        'IsInWhatsapp' => true,
                        'JID' => '5491155554444@s.whatsapp.net',
                        'Query' => '5491155554444',
                        'VerifiedName' => '',
                    ],
                ],
            ],
        ]),
    ]);

    $result = $this->client->user->check(['5491155554444']);

    expect($result)->toHaveCount(1)
        ->and($result[0]->isInWhatsapp)->toBeTrue()
        ->and($result[0]->jid)->toBe('5491155554444@s.whatsapp.net');
});

it('gets user info', function () {
    Http::fake([
        'http://localhost:8080/user/info' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'Users' => [
                    '5491155554444@s.whatsapp.net' => [
                        'Devices' => ['device1'],
                        'PictureID' => 'pic-123',
                        'Status' => 'Hey there!',
                        'VerifiedName' => null,
                    ],
                ],
            ],
        ]),
    ]);

    $result = $this->client->user->getInfo(['5491155554444']);

    expect($result)->toHaveCount(1);
});

it('gets user avatar', function () {
    Http::fake([
        'http://localhost:8080/user/avatar' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'URL' => 'https://avatar.example.com/pic.jpg',
                'ID' => 'pic-123',
                'Type' => 'image',
                'DirectPath' => '/path/to/pic',
            ],
        ]),
    ]);

    $avatar = $this->client->user->getAvatar('5491155554444');

    expect($avatar->url)->toBe('https://avatar.example.com/pic.jpg')
        ->and($avatar->id)->toBe('pic-123');
});

it('gets user LID', function () {
    Http::fake([
        'http://localhost:8080/user/lid/*' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'LID' => '165434221441206@lid',
                'Phone' => '5491155554444',
            ],
        ]),
    ]);

    $lid = $this->client->user->getLid('5491155554444');

    expect($lid->lid)->toBe('165434221441206@lid');
});
