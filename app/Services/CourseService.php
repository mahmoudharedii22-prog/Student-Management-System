<?php

namespace App\Services;

use App\Contracts\CourseRepositoryInterface;
use App\Models\Course;

class CourseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private CourseRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function all()
    {
        $courses = $this->repo->all();

        return $courses;
    }

    public function create(array $data): Course
    {
        $course = $this->repo->create($data);

        return $course;
    }

    public function update(array $data, Course $course): Course
    {
        $course = $this->repo->update($data, $course);

        return $course;
    }
    public function delete(Course $course): void
    {
        $this->repo->delete($course);
    }
}
