<?php

namespace App\Contracts;

use App\Models\Enrollment;

interface EnrollmentRepositoryInterface
{
    public function create(array $data):Enrollment;

    public function delete(Enrollment $enrollment):void;
}
