<?php

namespace App\Services;

use App\Models\Course;
use App\Models\OrderItem;

class MyCourseService
{
    /**
     * Ambil semua kursus yang sudah dibeli user
     */
    public function getPurchasedCourses(string $userId)
    {
        $courseIds = OrderItem::whereHas('order', function ($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->where('status', 'paid');
            })
            ->pluck('course_id')
            ->unique();

        return Course::whereIn('id', $courseIds)->get();
    }

    /**
     * Ambil detail kursus + materi (jika user sudah bayar)
     */
    public function getCourseDetailForUser(string $userId, Course $course): Course
    {
        $hasPaid = OrderItem::where('course_id', $course->id)
            ->whereHas('order', function ($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->where('status', 'paid');
            })
            ->exists();

        if (! $hasPaid) {
            abort(403, 'Anda belum membeli kursus ini.');
        }

        return $course->load(['materials' => function ($q) {
            $q->orderBy('order_number');
        }]);
    }
}
