<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Enrollment\CreateEnrollmentRequest;
use App\Models\Enrollment;
use App\Services\EnrollmentService;
use App\Traits\ApiResponse;

class EnrollmentController extends Controller
{
    use ApiResponse;

    public function store(CreateEnrollmentRequest $request, EnrollmentService $service)
    {

        $enrollment = $service->create($request->validated());

        return $this->successWithData('Enrollment Created successfully', 201, $enrollment);
    }

    public function destroy(EnrollmentService $service, Enrollment $enrollment)
    {
        $service->delete($enrollment);

        return $this->success('Enrollment Deleted successfully', 200);
    }
}
