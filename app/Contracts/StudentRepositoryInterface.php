<?php

namespace App\Contracts;

use App\Models\User;

interface StudentRepositoryInterface
{
    public function update(array $data, User $user): User;

    public function delete(User $user);

    public function getStudentbyId($id): ?User;

    public function getStudentsWithFilters(array $filters, $perPage);

    public function getProfile():User;
}
