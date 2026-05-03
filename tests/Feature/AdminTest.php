<?php

use Bayurifkialghifari\WuzApi\DTOs\Admin\CreateUserRequest;
use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->client = new WuzApiClient('http://localhost:8080', 'admin-token');

    $this->fakeUser = [
        'id' => 'user-id-1',
        'name' => 'John Doe',
        'token' => 'user-token-123',
        'connected' => false,
        'loggedIn' => false,
        'jid' => '',
        'webhook' => '',
        'events' => [],
        'expiration' => 0,
        'qrcode' => '',
        'proxy_config' => [],
        's3_config' => [],
        'history' => 0,
    ];
});

it('lists all users', function () {
    Http::fake([
        'http://localhost:8080/admin/users' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [$this->fakeUser],
        ]),
    ]);

    $users = $this->client->admin->listUsers();

    expect($users)->toHaveCount(1)
        ->and($users[0]->name)->toBe('John Doe');
});

it('creates a user', function () {
    Http::fake([
        'http://localhost:8080/admin/users' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => $this->fakeUser,
        ]),
    ]);

    $request = new CreateUserRequest(name: 'John Doe', token: 'user-token-123');
    $user = $this->client->admin->addUser($request);

    expect($user->id)->toBe('user-id-1')
        ->and($user->name)->toBe('John Doe');
});

it('deletes a user', function () {
    Http::fake([
        'http://localhost:8080/admin/users/user-id-1' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => ['Details' => 'Deleted'],
        ]),
    ]);

    $result = $this->client->admin->deleteUser('user-id-1');

    expect($result)->toBeArray();
});
