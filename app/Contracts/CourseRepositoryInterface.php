<?php

namespace App\Contracts;

use App\Models\Course;

interface CourseRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, Course $course);
    public function delete(Course $course);

}
