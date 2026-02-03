<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Services\StudentService;
use App\Traits\ApiResponse;

class ProfileController extends Controller
{
    use ApiResponse;

    public function index(StudentService $service)
    {
        $student = $service->getProfile();

        return $this->successWithData('Found successfully', 200, $student);
    }
}
