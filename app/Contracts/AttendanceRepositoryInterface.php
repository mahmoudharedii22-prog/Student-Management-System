<?php

namespace App\Contracts;

use App\Models\Attendance;

interface AttendanceRepositoryInterface
{
    public function attendanceWithFilters(array $data);

    public function findAttendanceById($id);

    public function create(): Attendance;

    public function update(): Attendance;

    public function studentAttendance(array $filters, $perpage);
}
