<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CourseMaterial;
use App\Services\CourseProgressService;

class UserMaterialProgressController extends Controller
{
    public function store(CourseMaterial $material, CourseProgressService $service)
    {
        $service->markMaterialCompleted(auth()->id(), $material);

        return back()->with('success', 'Materi ditandai selesai');
    }
}
