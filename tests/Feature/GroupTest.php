<?php

use Bayurifkialghifari\WuzApi\WuzApiClient;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->client = new WuzApiClient('http://localhost:8080', 'test-token');

    $this->fakeGroupData = [
        'JID' => '120362@g.us',
        'Name' => 'Test Group',
        'OwnerJID' => '5491@s.whatsapp.net',
        'Topic' => 'A test group',
        'GroupCreated' => '2024-01-01T00:00:00Z',
        'IsAnnounce' => false,
        'IsLocked' => false,
        'IsEphemeral' => false,
        'Participants' => [],
        'AddressingMode' => '',
        'MemberAddMode' => '',
        'DisappearingTimer' => 0,
    ];
});

it('lists groups', function () {
    Http::fake([
        'http://localhost:8080/group/list' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => ['Groups' => [$this->fakeGroupData]],
        ]),
    ]);

    $groups = $this->client->group->list();

    expect($groups)->toHaveCount(1)
        ->and($groups[0]->name)->toBe('Test Group');
});

it('creates a group', function () {
    Http::fake([
        'http://localhost:8080/group/create' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => $this->fakeGroupData,
        ]),
    ]);

    $group = $this->client->group->create('Test Group', ['5491155554444']);

    expect($group->jid)->toBe('120362@g.us')
        ->and($group->name)->toBe('Test Group');
});

it('gets group info', function () {
    Http::fake([
        'http://localhost:8080/group/info*' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => $this->fakeGroupData,
        ]),
    ]);

    $group = $this->client->group->getInfo('120362@g.us');

    expect($group->jid)->toBe('120362@g.us');
});

it('updates group participants', function () {
    Http::fake([
        'http://localhost:8080/group/updateparticipants' => Http::response([
            'success' => true,
            'code' => 200,
            'data' => [
                'Updates' => [
                    ['JID' => '5491@s.whatsapp.net', 'Status' => 'added', 'Code' => 200],
                ],
            ],
        ]),
    ]);

    $updates = $this->client->group->updateParticipants('120362@g.us', 'add', ['5491155554444']);

    expect($updates)->toHaveCount(1)
        ->and($updates[0]->status)->toBe('added');
});
