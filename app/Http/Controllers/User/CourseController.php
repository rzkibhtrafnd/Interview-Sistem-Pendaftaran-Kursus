<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Services\UserCourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(
        protected UserCourseService $courseService
    ) {}

    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $courses = $this->courseService->paginate(
            $request->only('category_id', 'search')
        );

        return view('user.courses.index', compact(
            'courses',
            'categories'
        ));
    }

    public function show(Course $course)
    {
        $course = $this->courseService->findForUser($course);

        return view('user.courses.show', compact('course'));
    }
}
