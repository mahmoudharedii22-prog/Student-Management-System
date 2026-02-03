<?php

namespace App\Services;

use App\Contracts\StudentRepositoryInterface;
use App\Models\User;

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

    public function update(array $data, User $user)
    {

        return $this->repo->update($data, $user);
    }

    public function delete(User $user)
    {
        return $this->repo->delete($user);
    }

    public function all(array $filters)
    {
        return $this->repo->getStudentsWithFilters($filters, 5);

    }
    public function getProfile()
    {
        return $this->repo->getProfile();
    }
}
