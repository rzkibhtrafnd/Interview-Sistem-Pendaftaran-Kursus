<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Services\CourseService;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    public function index()
    {
        $courses = $this->courseService->paginate();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.courses.create', compact('categories'));
    }

    public function store(StoreCourseRequest $request)
    {
        $this->courseService->store($request->validated());

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function edit(Course $course)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.courses.edit', compact('course', 'categories'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $this->courseService->update($course, $request->validated());

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Kursus berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $this->courseService->delete($course);

        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Kursus berhasil dihapus.');
    }
}
