<?php

namespace App\Contracts\Emplementations;

use App\Contracts\GradeRepositoryInterface;
use App\Models\Enrollment;
use App\Models\Grade;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EloquentGradeRepository implements GradeRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getGradesWithFilters(array $filters): LengthAwarePaginator
    {
        $query = Grade::query();

        if (! empty($filters['student_id'])) {
            $query->where('student_id', $filters['student_id']);
        }

        if (! empty($filters['course_id'])) {
            $query->where('course_id', $filters['course_id']);
        }

        return $query->orderByRaw(" case grade_value 
        when 'A' then 1
        when 'B' then 2
        when 'C' then 3
        when 'D' then 4
        END")
            ->paginate($filters['per_page']);
    }

    public function create(array $data): Grade
    {

        try {
            $enrollment = Enrollment::where('student_id', $data['student_id'])
                ->where('course_id', $data['course_id'])
                ->firstOrFail();

        } catch (\Throwable $th) {
            throw new \Exception('This student is not enrolled in this course');
        }

        return Grade::create($data);
    }

    public function delete(Grade $grade): void
    {
        $grade->delete();
    }

    public function update(array $data, Grade $grade): Grade
    {
        $grade->update($data);

        return $grade;
    }

    public function getGrades(): Collection
    {
        return Auth::user()->grades()->orderbyraw('CASE grade_value WHEN "A" THEN 1 WHEN "B" THEN 2 WHEN "C" THEN 3 WHEN "D" THEN 4 END')->get();
    }
}
