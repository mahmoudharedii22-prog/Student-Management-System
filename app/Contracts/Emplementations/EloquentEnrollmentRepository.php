<?php

namespace App\Contracts\Emplementations;

use App\Contracts\EnrollmentRepositoryInterface;
use App\Models\Enrollment;

class EloquentEnrollmentRepository implements EnrollmentRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    public function create(array $data)
    {
        return Enrollment::create($data);
    }

    public function delete(Enrollment $enrollment)
    {
        return $enrollment->delete();
    }
}
