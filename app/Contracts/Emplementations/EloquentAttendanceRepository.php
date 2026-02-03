<?php

namespace App\Contracts\Emplementations;

use App\Contracts\AttendanceRepositoryInterface;
use App\Enums\AttendanceStatus;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class EloquentAttendanceRepository implements AttendanceRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function attendanceWithFilters(array $data)
    {
        $query = Attendance::query();

        if (! empty($data['student_id'])) {
            $query->where('student_id', $data['student_id']);
        }

        if (! empty($data['from']) && ! empty($data['to'])) {
            $query->whereBetween('date', [$data['from'], $data['to']]);

        }

        return $query->get();
    }

    public function findAttendanceById($id)
    {
        return Attendance::where('student_id', $id)->get();
    }

    public function create(): Attendance
    {
        $date = now()->toDateString();
        $user = Auth::user();
        $status = (int) date('H') > 9 ? AttendanceStatus::LATE : AttendanceStatus::PRESENT;

        return $user->attendances()->create([
            'date' => $date,
            'check_in_at' => now(),
            'status' => $status,
        ]);
    }

    public function update(): Attendance
    {
        $user = Auth::user();
        $date = now()->toDateString();
        $attendance = $user->attendances()->whereDate('date', $date)->whereNull('check_out_at')->first();
        if (! $attendance) {
            throw new \Exception('You have not checked in today');
        }
        $attendance->update([
            'check_out_at' => now(),
        ]);

        return $attendance;

    }

    public function studentAttendance(array $filters, $perpage)
    {
        $student = Auth::user();
        $query = Attendance::query()->where('student_id', $student->id);

        if ($filters['to'] < $filters['from']) {
            throw new \Exception('To date must be greater than from date');
        }

        if (! empty($filters['from']) && ! empty($filters['to'])) {

            $query->whereBetween('date', [$filters['from'], $filters['to']]);
        }

        return $query->paginate($perpage);
    }
}
