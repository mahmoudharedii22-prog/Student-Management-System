<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Course;
use App\Traits\ApiResponse;
use App\Services\CourseService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Http\Requests\course\GetAllCoursesRequest;
use App\Http\Requests\Course\RestoreDeletedCourseRequest;


class CourseController extends Controller
{
    use ApiResponse;

    public function index(CourseService $service, GetAllCoursesRequest $request)
    {

        $courses = $service->all($request->validated());

        return $this->successWithPagination('Found successfully', 200, $courses->items(), $courses);
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
        $service->softDelete($course);

        return $this->success('Course Deleted successfully', 200);
    }

    public function restore(CourseService $service, RestoreDeletedCourseRequest $request)
    {
        $validated = $request->validated();

        $deletedCourse = $service->findDeletedCourse($validated['id']);

        $service->restore($deletedCourse);

        return $this->successWithData('Course Restored successfully', 200, $deletedCourse);
    }

    public function forceDelete(CourseService $service, Course $course)
    {
        $service->forceDelete($course);

        return $this->success('Course forece-Deleted successfully', 200);
    }

    public function showDeleted(CourseService $service)
    {
        $courses = $service->showDeleted();

        return $this->successWithData('Found successfully', 200, $courses);
    }
}
