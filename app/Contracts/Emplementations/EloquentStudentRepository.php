<?php

namespace App\Contracts\Emplementations;

use App\Contracts\StudentRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EloquentStudentRepository implements StudentRepositoryInterface
{
    public function update(array $data, User $user): User
    {
        $user->update($data);

        return $user;
    }

    public function softDelete(User $user): void
    {
        $user->delete();
    }

    public function getStudentbyId($id): ?Collection
    {
        return User::find($id);
    }

    public function getStudentsWithFilters(array $filters, $perPage): LengthAwarePaginator
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

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getProfile(): User
    {
        return Auth::user();
    }

    public function showDeleted(): Collection
    {
        return User::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
    }

    public function forceDelete(User $user): void
    {
        $user->forceDelete();
    }

    public function restore(User $user): User
    {

        $user->restore();

        return $user;
    }

    public function findDeletedUser($id): ?User
    {
        return User::onlyTrashed()->find($id);
    }
}
