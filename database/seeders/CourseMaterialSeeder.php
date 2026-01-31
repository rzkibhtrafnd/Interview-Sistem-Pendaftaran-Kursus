<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\CourseMaterial;

class CourseMaterialSeeder extends Seeder
{
    public function run(): void
    {
        $laravelCourse = Course::where('title', 'Laravel 11 Fundamental')->first();

        CourseMaterial::insert([
            [
                'id' => Str::uuid(),
                'course_id' => $laravelCourse->id,
                'title' => 'Pengenalan Laravel 11',
                'content_url' => 'https://www.youtube.com/watch?v=example1',
                'order_number' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'course_id' => $laravelCourse->id,
                'title' => 'Routing & Controller',
                'content_url' => 'https://www.youtube.com/watch?v=example2',
                'order_number' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'course_id' => $laravelCourse->id,
                'title' => 'Blade & Layout',
                'content_url' => 'https://www.youtube.com/watch?v=example3',
                'order_number' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
