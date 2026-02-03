<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Grade\CreateGradeRequest;
use App\Http\Requests\Admin\Grade\GetAllGradesWithFilterGradeRequest;
use App\Http\Requests\Admin\Grade\UpdateGradeRequest;
use App\Models\Grade;
use App\Services\GradeService;
use App\Traits\ApiResponse;

class GradeController extends Controller
{
    use ApiResponse;

    public function index(GradeService $service, GetAllGradesWithFilterGradeRequest $request)
    {

        $grades = $service->all($request->validated());

        return $this->successWithdata('Found successfully', 200, $grades);
    }

    public function store(GradeService $service, CreateGradeRequest $request)
    {
        $grade = $service->create($request->validated());

        return $this->successWithData('Grade Created successfully', 201, $grade);
    }

    public function update(UpdateGradeRequest $request, GradeService $service, Grade $grade)
    {
        $service->update($request->validated(), $grade);

        return $this->successWithData('Grade Updated successfully', 200, $grade);
    }

    public function destroy(GradeService $service, Grade $grade)
    {
        $service->delete($grade);

        return $this->success('Grade Deleted successfully', 200);
    }
}
