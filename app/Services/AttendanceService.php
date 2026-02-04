<?php

namespace App\Services;

use App\Contracts\AttendanceRepositoryInterface;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private AttendanceRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function all(array $filters) // pagination
    {
        $filters['perpage'] = $filters['perpage'] ?? 10;

        return $this->repo->attendanceWithFilters($filters);
    }

    public function findAttendance($data)
    {
        $data['perpage'] = $data['perpage'] ?? 10;

        return $this->repo->findAttendanceById($data);
    }

    public function check_in(): Attendance
    {
        if (Auth::user()->attendances()->whereDate('date', now()->toDateString())->exists()) {
            throw new \Exception('You have already checked in today');
        }

        return $this->repo->create();
    }

    public function check_Out()
    {
        $user = Auth::user();

        $this->repo->update($user);
    }

    public function getStudentAttendance(array $filters)
    {
        $filters['perpage'] = $filters['perpage'] ?? 10;

        return $this->repo->studentAttendance($filters);
    }
}
