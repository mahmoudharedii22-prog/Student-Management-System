<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\CreateStudentRequest;
use App\Http\Requests\Admin\Student\GetAllStudentsWithfilterRequest;
use App\Http\Requests\admin\Student\UpdateStudentRequest;
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

    public function destroy(StudentService $service, $user)
    {

        $service->delete($user);

        return $this->success('Student Deleted successfully', 200);
    }

    public function show(StudentService $service, $id)
    {
        $user = $service->findStudentbyId($id);

        return $this->successWithData('Found successfully', 200, $user);
    }

    public function index(StudentService $service, GetAllStudentsWithfilterRequest $request)
    {

        $users = $service->all($request->validated());

        return $this->successWithPagination('Found successfully', 200, $users->items(), $users);

    }
}
