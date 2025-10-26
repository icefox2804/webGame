<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'The Legend of Heroes',
                'description' => 'Một game nhập vai hấp dẫn với cốt truyện phong phú và đồ họa tuyệt đẹp',
                'price' => 599000,
                'category_id' => 2,
                'age_rating' => 12,
            ],
            [
                'name' => 'Speed Racer 2024',
                'description' => 'Trải nghiệm tốc độ đỉnh cao với game đua xe chân thực nhất',
                'price' => 399000,
                'category_id' => 7,
                'age_rating' => 7,
            ],
            [
                'name' => 'Horror Mansion',
                'description' => 'Khám phá ngôi nhà ma ám đầy bí ẩn và kinh dị',
                'price' => 299000,
                'category_id' => 8,
                'age_rating' => 18,
            ],
            [
                'name' => 'Strategic Empire',
                'description' => 'Xây dựng đế chế của bạn với chiến thuật thông minh',
                'price' => 499000,
                'category_id' => 4,
                'age_rating' => 12,
            ],
            [
                'name' => 'Soccer Champions',
                'description' => 'Trở thành nhà vô địch bóng đá thế giới',
                'price' => 449000,
                'category_id' => 5,
                'age_rating' => 0,
            ],
            [
                'name' => 'Jungle Adventure',
                'description' => 'Phiêu lưu trong rừng nhiệt đới đầy nguy hiểm',
                'price' => 349000,
                'category_id' => 3,
                'age_rating' => 7,
            ],
            [
                'name' => 'Super Fighter X',
                'description' => 'Game đối kháng với các chiến binh huyền thoại',
                'price' => 549000,
                'category_id' => 1,
                'age_rating' => 16,
            ],
            [
                'name' => 'Puzzle Master',
                'description' => 'Thử thách trí tuệ với 1000+ câu đố logic',
                'price' => 199000,
                'category_id' => 6,
                'age_rating' => 0,
            ],
            [
                'name' => 'Space Explorer',
                'description' => 'Khám phá vũ trụ bao la và bí ẩn',
                'price' => 699000,
                'category_id' => 3,
                'age_rating' => 12,
            ],
            [
                'name' => 'Zombie Survival',
                'description' => 'Sinh tồn trong thế giới zombie tàn khốc',
                'price' => 459000,
                'category_id' => 1,
                'age_rating' => 18,
            ],
            [
                'name' => 'Kingdom Wars',
                'description' => 'Chiến tranh vương quốc với hàng nghìn quân đội',
                'price' => 529000,
                'category_id' => 4,
                'age_rating' => 12,
            ],
            [
                'name' => 'Basketball Pro',
                'description' => 'Trở thành ngôi sao bóng rổ chuyên nghiệp',
                'price' => 379000,
                'category_id' => 5,
                'age_rating' => 0,
            ],
            [
                'name' => 'Dragon Quest',
                'description' => 'Cuộc phiêu lưu săn rồng huyền thoại',
                'price' => 649000,
                'category_id' => 2,
                'age_rating' => 12,
            ],
            [
                'name' => 'Mind Bender',
                'description' => 'Game giải đố phức tạp cho người thông minh',
                'price' => 249000,
                'category_id' => 6,
                'age_rating' => 7,
            ],
            [
                'name' => 'Silent Hill Remake',
                'description' => 'Phiên bản làm lại của game kinh dị huyền thoại',
                'price' => 799000,
                'category_id' => 8,
                'age_rating' => 18,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
