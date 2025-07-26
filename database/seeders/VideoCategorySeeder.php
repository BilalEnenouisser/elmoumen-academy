<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoCategory;

class VideoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'آباء',
                'slug' => 'abaa',
                'description' => 'فيديوهات خاصة بالأباء'
            ],
            [
                'name' => 'تلاميذ',
                'slug' => 'talamid',
                'description' => 'فيديوهات خاصة بالتلاميذ'
            ],
            [
                'name' => 'أجي تغير حياتك',
                'slug' => 'ajji',
                'description' => 'فيديوهات تحفيزية لتغيير الحياة'
            ]
        ];

        foreach ($categories as $category) {
            VideoCategory::create($category);
        }
    }
} 