<?php

namespace App\Contracts\Emplementations;

use App\Contracts\CourseRepositoryInterface;
use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class EloquentCourseRepository implements CourseRepositoryInterface
{
    public function all($perpage): LengthAwarePaginator
    {
        return Course::paginate($perpage);
    }

    public function create(array $data): Course
    {
        return Course::create($data);
    }

    public function update(array $data, Course $course): Course
    {
        $course->update($data);

        return $course;
    }

    public function softDelete(Course $course): void
    {
        $course->delete();
    }

    public function forceDelete(Course $course): void
    {
        $course->forceDelete();
    }

    public function showDeleted($perPage): Collection
    {
        return Course::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate($perPage);
    }

    public function getMycourses(): collection
    {
        return Auth::user()->courses()->get();
    }

    public function restore(Course $course): Course
    {
        return $course->restore();
    }
}
