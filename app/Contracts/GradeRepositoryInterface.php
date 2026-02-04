<?php

namespace App\Contracts;

use App\Models\Grade;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GradeRepositoryInterface
{
    public function getGradesWithFilters(array $filters): LengthAwarePaginator;

    public function create(array $data): Grade;

    public function delete(Grade $grade):void;

    public function update(array $data, Grade $grade): Grade;

    public function getGrades():Collection;
}
