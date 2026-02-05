<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface StudentRepositoryInterface
{
    public function update(array $data, User $user): User;

    public function softDelete(User $user): void;

    public function getStudentbyId($id): ?Collection;

    public function getStudentsWithFilters(array $filters, $perPage): LengthAwarePaginator;

    public function getProfile(): User;

    public function showDeleted(): Collection;

    public function forceDelete(User $user): void;

    public function restore(User $user): User;

    public function findDeletedUser($id): ?User;
}
