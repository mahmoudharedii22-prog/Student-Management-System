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
        $courses = $service->getMycourses();

        return $this->successWithData('Found successfully', 200 , $courses);
    }
}
