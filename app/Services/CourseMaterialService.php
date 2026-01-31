<?php

namespace App\Services;

use App\Models\CourseMaterial;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CourseMaterialService
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return CourseMaterial::with('course')
            ->orderBy('course_id')
            ->orderBy('order_number')
            ->paginate($perPage);
    }

    public function store(array $data): CourseMaterial
    {
        return CourseMaterial::create($data);
    }

    public function update(CourseMaterial $material, array $data): CourseMaterial
    {
        $material->update($data);
        return $material;
    }

    public function delete(CourseMaterial $material): void
    {
        $material->delete();
    }
}
