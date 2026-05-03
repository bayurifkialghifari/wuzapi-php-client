<?php

namespace Bayurifkialghifari\WuzApi\Modules;

use Bayurifkialghifari\WuzApi\DTOs\User\Contact;
use Bayurifkialghifari\WuzApi\DTOs\User\UserAvatarResponse;
use Bayurifkialghifari\WuzApi\DTOs\User\UserCheck;
use Bayurifkialghifari\WuzApi\DTOs\User\UserInfo;
use Bayurifkialghifari\WuzApi\DTOs\User\UserLidResponse;
use Bayurifkialghifari\WuzApi\WuzApiClient;

class UserModule
{
    public function __construct(protected WuzApiClient $client) {}

    /**
     * Get info for multiple phone numbers.
     *
     * @param  string[]  $phones
     * @return array<string, UserInfo>
     */
    public function getInfo(array $phones, ?string $token = null): array
    {
        $data = $this->client->post('/user/info', ['Phone' => $phones], $token);
        $users = (array) (is_array($data) ? ($data['Users'] ?? $data) : $data);

        return array_map(fn (array $u) => UserInfo::fromArray($u), $users);
    }

    /**
     * Check if phone numbers are registered WhatsApp users.
     *
     * @param  string[]  $phones
     * @return UserCheck[]
     */
    public function check(array $phones, ?string $token = null): array
    {
        $data = $this->client->post('/user/check', ['Phone' => $phones], $token);
        $users = (array) (is_array($data) ? ($data['Users'] ?? $data) : $data);

        return array_map(fn (array $u) => UserCheck::fromArray($u), $users);
    }

    /**
     * Get user avatar / profile picture.
     */
    public function getAvatar(string $phone, bool $preview = true, ?string $token = null): UserAvatarResponse
    {
        $data = $this->client->post('/user/avatar', ['Phone' => $phone, 'Preview' => $preview], $token);

        return UserAvatarResponse::fromArray((array) $data);
    }

    /**
     * Get all contacts.
     *
     * @return array<string, Contact>
     */
    public function getContacts(?string $token = null): array
    {
        $data = $this->client->get('/user/contacts', [], $token);

        return array_map(fn (array $c) => Contact::fromArray($c), (array) $data);
    }

    /**
     * Send user presence (available/unavailable).
     */
    public function sendPresence(string $presenceType, ?string $token = null): array
    {
        return (array) $this->client->post('/user/presence', ['type' => $presenceType], $token);
    }

    /**
     * Get Linked ID from phone number.
     */
    public function getLid(string $phone, ?string $token = null): UserLidResponse
    {
        $data = $this->client->get('/user/lid/'.rawurlencode($phone), [], $token);

        return UserLidResponse::fromArray((array) $data);
    }
}
