<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $webCategory = Category::where('name', 'Web Development')->first();
        $dataCategory = Category::where('name', 'Data Science')->first();

        Course::insert([
            [
                'id' => Str::uuid(),
                'category_id' => $webCategory->id,
                'title' => 'Laravel 11 Fundamental',
                'description' => 'Belajar Laravel 11 dari dasar hingga mahir',
                'price' => 500000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'category_id' => $dataCategory->id,
                'title' => 'Python untuk Data Science',
                'description' => 'Dasar data science menggunakan Python',
                'price' => 450000,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
