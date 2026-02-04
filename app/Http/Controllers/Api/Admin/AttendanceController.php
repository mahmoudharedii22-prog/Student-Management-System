<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Attendance\GetAllAttendanceWithFilersRequest;
use App\Http\Requests\Attendance\GetStudentAttendanceRequest;
use App\Services\AttendanceService;
use App\Traits\ApiResponse;

class AttendanceController extends Controller
{
    use ApiResponse;

    public function index(GetAllAttendanceWithFilersRequest $request, AttendanceService $service)
    {

        $attendance = $service->all($request->validated());

        return $this->successWithPagination('Found successfully', 200, $attendance->items(), $attendance);
    }

    public function show(AttendanceService $service,GetStudentAttendanceRequest $request)
    {
        $attendance = $service->findAttendance($request->validated());

        return $this->successWithData('Attendance retrieved successfully', 200, $attendance);
    }
}
