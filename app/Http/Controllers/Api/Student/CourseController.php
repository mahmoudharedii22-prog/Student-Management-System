<?php

namespace App\Http\Controllers\Api\Student;

use App\Traits\ApiResponse;
use App\Services\CourseService;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    use ApiResponse;

    public function index(CourseService $service)
    {
        $service->all();

        return $this->success('Found successfully', 200);
    }
}
