<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Requests\Student\GetAllStudentsWithfilterRequest;
use App\Http\Requests\Student\ShowStudentByIdRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Models\User;
use App\Services\SessionService;
use App\Services\StudentService;
use App\Traits\ApiResponse;

class StudentController extends Controller
{
    use ApiResponse;

    public function store(CreateStudentRequest $request, SessionService $service)
    {

        $user = $service->register($request->validated());

        return $this->successWithData('Student Created successfully', 201, $user);
    }

    public function update(UpdateStudentRequest $request, StudentService $service, User $user)
    {

        $user = $service->update($request->validated(), $user);

        return $this->successWithData('Student Updated successfully', 200, $user);
    }

    public function destroy(StudentService $service, User $user)
    {

        $service->softDelete($user);

        return $this->success('Student Deleted successfully', 200);
    }

    public function show(StudentService $service, ShowStudentByIdRequest $request)
    {
        $user = $service->findStudentbyId($request->validated());

        return $this->successWithData('Student found successfully', 200, $user);
    }

    public function index(StudentService $service, GetAllStudentsWithfilterRequest $request) // pagination
    {

        $users = $service->all($request->validated());

        return $this->successWithPagination('Students retrieved successfully', 200, $users->items(), $users);

    }

    public function forceDelete(StudentService $service, User $user)
    {
        $service->forceDelete($user);

        return $this->success('Student Deleted successfully', 200);
    }

    public function restore(StudentService $service, User $user)
    {
        $restoredUser = $service->restore($user);

        return $this->successWithData('Student Restored successfully', 200, $restoredUser);
    }

    public function showDeleted(StudentService $service)
    {
        $deletedUsers = $service->showDeleted();
    }
}
