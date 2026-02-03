<?php

namespace App\Services;

use App\Contracts\SessionRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SessionService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private SessionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        return $this->repo->create($data);
    }

    public function login(array $data)
    {
        $user = $this->repo->findByEmail($data);
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $this->repo->login($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(User $user)
    {

        return $this->repo->deleteToken($user);
    }
}
