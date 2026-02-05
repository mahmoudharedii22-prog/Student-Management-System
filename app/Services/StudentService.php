<?php

namespace App\Services;

use App\Contracts\StudentRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class StudentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private StudentRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function findStudentbyId($id)
    {
        $student = $this->repo->getStudentbyId($id);
        if ($student) {
            return $student;
        }
        throw new \Exception('Student not found');
    }

    public function update(array $data, User $user): User
    {

        return $this->repo->update($data, $user);
    }

    public function softDelete(User $user): void
    {
        $this->repo->softDelete($user);
    }

    public function all(array $filters): LengthAwarePaginator // pagination
    {
        $filters['perpage'] = $filters['perpage'] ?? 10;

        return $this->repo->getStudentsWithFilters($filters, $filters['perpage']);

    }

    public function getProfile(): User
    {
        return $this->repo->getProfile();
    }

    public function forceDelete(User $user): void
    {
        $this->repo->forceDelete($user);
    }

    public function showDeleted(): Collection
    {
        return $this->repo->showDeleted();
    }

    public function restore(User $user): User
    {
        if ($user) {
            return $this->repo->restore($user);
        }

        throw new \Exception('User not found');
    }

    public function findDeletedUser($id): ?User
    {
        return $this->repo->findDeletedUser($id);
    }
}
