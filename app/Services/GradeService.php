<?php

namespace App\Services;

use App\Contracts\GradeRepositoryInterface;
use App\Models\Grade;

class GradeService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private GradeRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function all(array $filters)
    {
        return $this->repo->getGradesWithFilters($filters);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

    public function delete(Grade $grade)
    {
        return $this->repo->delete($grade);
    }

    public function update(array $data, Grade $grade)
    {
        return $grade->update($data);
    }
    public function getGrades()
    {
        return $this->repo->getGrades();
    }
}
