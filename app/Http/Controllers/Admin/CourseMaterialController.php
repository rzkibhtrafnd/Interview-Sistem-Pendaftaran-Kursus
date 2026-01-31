<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseMaterialRequest;
use App\Http\Requests\Admin\UpdateCourseMaterialRequest;
use App\Models\Course;
use App\Models\CourseMaterial;
use App\Services\CourseMaterialService;

class CourseMaterialController extends Controller
{
    public function __construct(
        protected CourseMaterialService $materialService
    ) {}

    public function index()
    {
        $materials = $this->materialService->paginate();
        return view('admin.course-materials.index', compact('materials'));
    }

    public function create()
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.course-materials.create', compact('courses'));
    }

    public function store(StoreCourseMaterialRequest $request)
    {
        $this->materialService->store($request->validated());

        return redirect()
            ->route('admin.course-materials.index')
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(CourseMaterial $course_material)
    {
        $courses = Course::orderBy('title')->get();
        return view('admin.course-materials.edit', [
            'material' => $course_material,
            'courses'  => $courses,
        ]);
    }

    public function update(UpdateCourseMaterialRequest $request, CourseMaterial $course_material)
    {
        $this->materialService->update($course_material, $request->validated());

        return redirect()
            ->route('admin.course-materials.index')
            ->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(CourseMaterial $course_material)
    {
        $this->materialService->delete($course_material);

        return redirect()
            ->route('admin.course-materials.index')
            ->with('success', 'Materi berhasil dihapus.');
    }
}
