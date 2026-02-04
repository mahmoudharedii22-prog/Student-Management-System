<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\GetMyAttendanceRequest;
use App\Services\AttendanceService;
use App\Traits\ApiResponse;

class AttendanceController extends Controller
{
    use ApiResponse;

    public function index(AttendanceService $service, GetMyAttendanceRequest $request)
    {

        $studentAttendance = $service->getStudentAttendance($request->validated());

        return $this->successWithPagination('Found successfully', 200, $studentAttendance->items(), $studentAttendance);
    }

    public function store(AttendanceService $service) // check - in
    {
        $service->check_In();

        return $this->success('checked in successfully', 200);
    }

    public function update(AttendanceService $service) // check - out
    {
        $service->check_Out();

        return $this->success('checked out successfully', 200);
    }
}
