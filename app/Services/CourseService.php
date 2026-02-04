<?php

namespace App\Services;

use App\Contracts\CourseRepositoryInterface;
use App\Models\Course;
use Illuminate\Support\Collection;

class CourseService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private CourseRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function all($perpage) // pagination
    {

        return $this->repo->all($perpage);

    }

    public function create(array $data): Course
    {

        return $this->repo->create($data);
    }

    public function update(array $data, Course $course): Course
    {

        return $this->repo->update($data, $course);
    }

    public function getMycourses(): Collection
    {
        return $this->repo->getMycourses();
    }

    public function softDelete(Course $course): void
    {
        $this->repo->softDelete($course);
    }

    public function restore(Course $course): void
    {
        $this->repo->restore($course);
    }

    public function forceDelete(Course $course): void
    {
        $this->repo->forceDelete($course);
    }

    public function showDeleted($perPage): Collection
    {
        return $this->repo->showDeleted($perPage);
    }
}
