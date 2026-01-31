<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Certificate;
use App\Models\UserMaterialProgress;
use App\Services\MyCourseService;

class MyCourseController extends Controller
{
    public function __construct(
        protected MyCourseService $myCourseService
    ) {}

    /**
     * List kursus yang sudah dibeli
     */
    public function index()
    {
        $courses = $this->myCourseService
            ->getPurchasedCourses(auth()->id());

        return view('user.my-courses.index', compact('courses'));
    }

    /**
     * Detail kursus + materi
     */
    public function show(Course $course)
    {
        $userId = auth()->id();

        $completedMaterialIds = UserMaterialProgress::where('user_id', $userId)
            ->where('course_id', $course->id)
            ->where('is_completed', true)
            ->pluck('material_id')
            ->toArray();

        $certificate = Certificate::where('user_id', $userId)
            ->where('course_id', $course->id)
            ->first();

        return view('user.my-courses.show', compact(
            'course',
            'completedMaterialIds',
            'certificate'
        ));
    }
}
