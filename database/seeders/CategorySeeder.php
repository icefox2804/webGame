<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Action',
                'description' => 'Game hành động đầy kịch tính và gay cấn'
            ],
            [
                'name' => 'RPG',
                'description' => 'Game nhập vai với cốt truyện phong phú'
            ],
            [
                'name' => 'Adventure',
                'description' => 'Game phiêu lưu khám phá thế giới mới'
            ],
            [
                'name' => 'Strategy',
                'description' => 'Game chiến thuật, thử thách trí tuệ'
            ],
            [
                'name' => 'Sports',
                'description' => 'Game thể thao sôi động'
            ],
            [
                'name' => 'Puzzle',
                'description' => 'Game giải đố, rèn luyện tư duy'
            ],
            [
                'name' => 'Racing',
                'description' => 'Game đua xe tốc độ cao'
            ],
            [
                'name' => 'Horror',
                'description' => 'Game kinh dị, mạo hiểm'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
