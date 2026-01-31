<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id' => Str::uuid(),
                'name' => 'Web Development',
                'description' => 'Kursus pengembangan website',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Mobile Development',
                'description' => 'Kursus pengembangan aplikasi mobile',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Data Science',
                'description' => 'Kursus data dan machine learning',
            ],
        ];

        Category::insert($categories);
    }
}
