<?php

namespace App\Contracts\Emplementations;

use App\Models\User;
use App\Enums\StudentStatus;
use App\Contracts\SessionRepositoryInterface;

class EloquentSessionRepository implements SessionRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function login(User $user):string
    {
        $token = $user->createToken('api-token')->plainTextToken;
        $user->status = StudentStatus::ACTIVE;
        $user->save();
        return $token;
    }

    public function deleteToken(User $user): bool
    {
        try {
            $user->tokens()->delete();
            return true;

        } catch (\Exception $e) {
            throw new \Exception('Error deleting token');
        }
    }
    public function findByEmail(array $data): ?User
    {
        return User::where('email', $data['email'])->first();
    }
}
