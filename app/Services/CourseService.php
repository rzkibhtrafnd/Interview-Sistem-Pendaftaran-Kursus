<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CourseService
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Course::with('category')
            ->latest()
            ->paginate($perPage);
    }

    public function store(array $data): Course
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data): Course
    {
        $course->update($data);
        return $course;
    }

    public function delete(Course $course): void
    {
        $course->delete();
    }
}
