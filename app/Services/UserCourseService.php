<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserCourseService
{
    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return Course::query()
            ->with('category')
            ->withCount('materials')
            ->where('status', 'active')
            ->when($filters['category_id'] ?? null, function ($q, $categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();
    }

    public function findForUser(Course $course): Course
    {
        return Course::with([
                'category',
                'materials' => fn ($q) => $q->orderBy('order_number')
            ])
            ->where('status', 'active')
            ->findOrFail($course->id);
    }
}
