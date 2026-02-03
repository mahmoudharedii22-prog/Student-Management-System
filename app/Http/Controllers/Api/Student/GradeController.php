<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Services\GradeService;
use App\Traits\ApiResponse;

class GradeController extends Controller
{
    use ApiResponse;

    public function index(GradeService $service)
    {
        $grades = $service->getGrades();

        return $this->success('Found successfully', 200);
    }
}
