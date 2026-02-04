<?php

namespace App\Contracts;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CourseRepositoryInterface
{
    public function all($perPage): LengthAwarePaginator;

    public function create(array $data): Course;

    public function update(array $data, Course $course): Course;

    public function softDelete(Course $course): void;

    public function forceDelete(Course $course): void;

    public function showDeleted($perPage): Collection;

    public function getMycourses(): Collection;

    public function restore(Course $course): Course;
    
}
