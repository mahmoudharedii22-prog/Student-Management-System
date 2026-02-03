<?php

namespace App\Services;

use App\Models\Enrollment;
use App\Contracts\EnrollmentRepositoryInterface;

class EnrollmentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private EnrollmentRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function delete(Enrollment $enrollment)
    {
        return $this->repo->delete($enrollment);
    }
}
