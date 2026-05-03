<?php

namespace Bayurifkialghifari\WuzApi\Modules;

use Bayurifkialghifari\WuzApi\DTOs\Admin\AdminUser;
use Bayurifkialghifari\WuzApi\DTOs\Admin\CreateUserRequest;
use Bayurifkialghifari\WuzApi\DTOs\Admin\UpdateUserRequest;
use Bayurifkialghifari\WuzApi\WuzApiClient;

class AdminModule
{
    public function __construct(protected WuzApiClient $client) {}

    /** @return AdminUser[] */
    public function listUsers(?string $token = null): array
    {
        $data = $this->client->get('/admin/users', [], $token);

        return array_map(fn (array $u) => AdminUser::fromArray($u), (array) $data);
    }

    public function getUser(string $id, ?string $token = null): AdminUser
    {
        $data = $this->client->get("/admin/users/{$id}", [], $token);

        return AdminUser::fromArray((array) $data);
    }

    public function addUser(CreateUserRequest $request, ?string $token = null): AdminUser
    {
        $data = $this->client->post('/admin/users', $request->toArray(), $token);

        return AdminUser::fromArray((array) $data);
    }

    public function updateUser(string $id, UpdateUserRequest $request, ?string $token = null): AdminUser
    {
        $data = $this->client->put("/admin/users/{$id}", $request->toArray(), $token);

        return AdminUser::fromArray((array) $data);
    }

    public function deleteUser(string $id, ?string $token = null): array
    {
        return (array) $this->client->delete("/admin/users/{$id}", [], $token);
    }

    public function deleteUserComplete(string $id, ?string $token = null): array
    {
        return (array) $this->client->delete("/admin/users/{$id}/full", [], $token);
    }
}
