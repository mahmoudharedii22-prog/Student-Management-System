<?php

namespace App\Contracts;

use App\Models\User;

interface SessionRepositoryInterface
{
    public function create(array $data): User;

    public function findByEmail(array $data): ?User;

    public function login(User $user): string; //token

    public function deleteToken(User $user): bool;
}
