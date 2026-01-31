<?php
namespace App\Services;

use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\UserMaterialProgress;
use App\Models\Certificate;
use Illuminate\Support\Str;

class CourseProgressService
{
    public function markMaterialCompleted($userId, CourseMaterial $material)
    {
        UserMaterialProgress::updateOrCreate(
            [
                'user_id' => $userId,
                'material_id' => $material->id,
            ],
            [
                'course_id' => $material->course_id,
                'is_completed' => true,
            ]
        );

        $this->checkAndGenerateCertificate($userId, $material->course_id);
    }

    public function checkAndGenerateCertificate($userId, $courseId)
    {
        $totalMaterials = CourseMaterial::where('course_id', $courseId)->count();

        $completed = UserMaterialProgress::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->where('is_completed', true)
            ->count();

        if ($totalMaterials > 0 && $totalMaterials === $completed) {
            Certificate::firstOrCreate(
                [
                    'user_id' => $userId,
                    'course_id' => $courseId,
                ],
                [
                    'certificate_code' => strtoupper(Str::random(10)),
                ]
            );
        }
    }
}
