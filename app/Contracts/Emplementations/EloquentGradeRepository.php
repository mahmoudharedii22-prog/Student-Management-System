<?php

namespace App\Contracts\Emplementations;

use App\Contracts\GradeRepositoryInterface;
use App\Models\Enrollment;
use App\Models\Grade;
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

    public function getGradesWithFilters(array $filters)
    {
        $query = Grade::query();

        if (! empty($filters['student_id'])) {
            $query->where('student_id', $filters['student_id']);
        }

        if (! empty($filters['course_id'])) {
            $query->where('course_id', $filters['course_id']);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        try {
            Enrollment::findorfail()->where('student_id', $data['student_id'])->where('course_id', $data['course_id']);

        } catch (\Throwable $th) {
            throw new \Exception('This student is not enrolled in this course');
        }

        return Grade::create($data);
    }

    public function delete(Grade $grade)
    {

        return $grade->delete();
    }

    public function update(array $data, Grade $grade)
    {
        return $grade->update($data);
    }

    public function getGrades()
    {
        return Auth::user()->grades()->get();
    }
}
