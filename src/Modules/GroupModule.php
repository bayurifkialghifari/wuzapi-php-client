<?php

namespace Bayurifkialghifari\WuzApi\Modules;

use Bayurifkialghifari\WuzApi\DTOs\Group\GroupInfo;
use Bayurifkialghifari\WuzApi\DTOs\Group\ParticipantUpdate;
use Bayurifkialghifari\WuzApi\WuzApiClient;

class GroupModule
{
    public function __construct(protected WuzApiClient $client) {}

    /** @return GroupInfo[] */
    public function list(?string $token = null): array
    {
        $data = $this->client->get('/group/list', [], $token);
        $groups = is_array($data) ? ($data['Groups'] ?? $data) : [];

        return array_map(fn (array $g) => GroupInfo::fromArray($g), $groups);
    }

    public function getInfo(string $groupJid, ?string $token = null): GroupInfo
    {
        $data = $this->client->get('/group/info', ['groupJID' => $groupJid], $token);

        return GroupInfo::fromArray((array) $data);
    }

    /** @param string[] $participants */
    public function create(string $name, array $participants, ?string $token = null): GroupInfo
    {
        $data = $this->client->post('/group/create', ['Name' => $name, 'Participants' => $participants], $token);

        return GroupInfo::fromArray((array) $data);
    }

    public function leave(string $groupJid, ?string $token = null): array
    {
        return (array) $this->client->post('/group/leave', ['GroupJID' => $groupJid], $token);
    }

    public function getInviteLink(string $groupJid, bool $reset = false, ?string $token = null): string
    {
        $data = $this->client->get('/group/invitelink', ['groupJID' => $groupJid, 'reset' => $reset], $token);

        return (string) (is_array($data) ? ($data['InviteLink'] ?? '') : $data);
    }

    public function join(string $inviteCode, ?string $token = null): array
    {
        return (array) $this->client->post('/group/join', ['Code' => $inviteCode], $token);
    }

    public function getInviteInfo(string $inviteCode, ?string $token = null): array
    {
        return (array) $this->client->post('/group/inviteinfo', ['Code' => $inviteCode], $token);
    }

    /**
     * @param  string[]  $participants
     * @param  'add'|'remove'|'promote'|'demote'  $action
     * @return ParticipantUpdate[]
     */
    public function updateParticipants(string $groupJid, string $action, array $participants, ?string $token = null): array
    {
        $data = $this->client->post('/group/updateparticipants', [
            'GroupJID' => $groupJid,
            'Action' => $action,
            'Participants' => $participants,
        ], $token);
        $updates = is_array($data) ? ($data['Updates'] ?? $data) : [];

        return array_map(fn (array $u) => ParticipantUpdate::fromArray($u), $updates);
    }

    public function setName(string $groupJid, string $name, ?string $token = null): array
    {
        return (array) $this->client->post('/group/name', ['GroupJID' => $groupJid, 'Name' => $name], $token);
    }

    public function setTopic(string $groupJid, string $topic, ?string $token = null): array
    {
        return (array) $this->client->post('/group/topic', ['GroupJID' => $groupJid, 'Topic' => $topic], $token);
    }

    public function setAnnounce(string $groupJid, bool $announce, ?string $token = null): array
    {
        return (array) $this->client->post('/group/announce', ['GroupJID' => $groupJid, 'Announce' => $announce], $token);
    }

    public function setLocked(string $groupJid, bool $locked, ?string $token = null): array
    {
        return (array) $this->client->post('/group/locked', ['GroupJID' => $groupJid, 'Locked' => $locked], $token);
    }

    /** @param '24h'|'7d'|'90d'|'off' $duration */
    public function setEphemeral(string $groupJid, string $duration, ?string $token = null): array
    {
        return (array) $this->client->post('/group/ephemeral', ['GroupJID' => $groupJid, 'Duration' => $duration], $token);
    }

    public function setPhoto(string $groupJid, string $image, ?string $token = null): array
    {
        return (array) $this->client->post('/group/photo', ['GroupJID' => $groupJid, 'Image' => $image], $token);
    }

    public function removePhoto(string $groupJid, ?string $token = null): array
    {
        return (array) $this->client->post('/group/photo/remove', ['GroupJID' => $groupJid], $token);
    }
}
