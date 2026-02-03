<?php

namespace App\Contracts\Emplementations;

use App\Contracts\CourseRepositoryInterface;
use App\Models\Course;

class EloquentCourseRepository implements CourseRepositoryInterface
{
    public function all()
    {
        return Course::all();
    }
    public function create(array $data):Course
    {
        return Course::create($data);
    }
    public function update(array $data, Course $course):Course
    {
        $course->update($data);

        return $course;
    }
    public function delete(Course $course):void
    {
        $course->delete();
    }
}
