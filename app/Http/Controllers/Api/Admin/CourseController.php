<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Course;
use App\Traits\ApiResponse;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CreateCourseRequest;
use App\Http\Requests\Admin\Course\UpdateCourseRequest;

class CourseController extends Controller
{
    use ApiResponse;
    public function index(CourseService $service)
    {

        $courses = $service->all();

        return $this->successWithdata('Found successfully', 200, $courses);
    }

    public function store(CreateCourseRequest $request, CourseService $service)
    {

        $course = $service->create($request->validated());

        return $this->successWithData('Course Created successfully', 201, $course);
    }

    public function update(CourseService $service, UpdateCourseRequest $request, Course $course)
    {
        $course = $service->update($request->validated(), $course);

        return $this->successWithData('Course Updated successfully', 200, $course);
    }

    public function destroy(CourseService $service, Course $course)
    {
        $service->delete($course);

        return $this->success('Course Deleted successfully', 200);
    }
}
