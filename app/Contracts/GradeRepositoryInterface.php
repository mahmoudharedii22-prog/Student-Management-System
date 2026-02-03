<?php

namespace App\Contracts;

use App\Models\Grade;

interface GradeRepositoryInterface
{
    public function getGradesWithFilters(array $filters);

    public function create(array $data);

    public function delete(Grade $grade);

    public function update(array $data, Grade $grade);
    
    public function getGrades();
}
