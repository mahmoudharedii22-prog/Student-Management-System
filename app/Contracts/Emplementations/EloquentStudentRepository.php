<?php

namespace App\Contracts\Emplementations;

use App\Contracts\StudentRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EloquentStudentRepository implements StudentRepositoryInterface
{
    public function update(array $data, User $user): User
    {
        $user->update($data);

        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    public function getStudentbyId($id): ?User
    {
        return User::find($id);
    }

    public function getStudentsWithFilters(array $filters, $perPage)
    {
        $query = User::query()->where('role', 'student');

        if (! empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('email', 'like', "%{$filters['search']}%");
            });
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $perPage = $filters['per_page'] ?? 15;

        return $query->paginate($perPage);
    }

    public function getProfile(): User
    {
        return Auth::user();
    }
}
