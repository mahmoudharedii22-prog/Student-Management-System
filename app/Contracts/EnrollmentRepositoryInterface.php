<?php

namespace App\Contracts;

use App\Models\Enrollment;

interface EnrollmentRepositoryInterface
{
    public function create(array $data);

    public function delete(Enrollment $enrollment);
}
