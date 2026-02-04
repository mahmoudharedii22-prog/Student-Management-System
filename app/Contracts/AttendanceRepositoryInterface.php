<?php

namespace App\Contracts;

use App\Models\Attendance;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface AttendanceRepositoryInterface
{
    public function attendanceWithFilters(array $filters): LengthAwarePaginator;

    public function findAttendanceById(array $data): ?LengthAwarePaginator;

    public function create(): Attendance;

    public function update(): Attendance;

    public function studentAttendance(array $filters): LengthAwarePaginator;
}
