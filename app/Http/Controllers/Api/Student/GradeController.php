<?php

namespace App\Http\Controllers\Api\Student;

use App\Traits\ApiResponse;
use App\Services\GradeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\GetStudentGradesRequest;

class GradeController extends Controller
{
    use ApiResponse;

    public function index(GradeService $service )
    {
        $grades = $service->getGrades();

        return $this->successWithData('Found successfully', 200 , $grades);
    }
}
