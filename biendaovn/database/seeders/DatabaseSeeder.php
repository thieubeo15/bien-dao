<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. TẠO TÀI KHOẢN (USER)
        // Tạo ông trùm Admin
        $admin = User::create([
            'name' => 'Tong Tu Lenh',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Tạo nhân viên BTV
        $btv = User::create([
            'name' => 'Nguyen Van BTV',
            'email' => 'btv@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'btv',
        ]);

        // 2. TẠO DANH MỤC (CATEGORIES)
        $cat1 = Category::create(['name' => 'Thời sự Biển Đông']);
        $cat2 = Category::create(['name' => 'Kinh tế Biển']);
        $cat3 = Category::create(['name' => 'Văn bản Pháp luật']);
        $cat4 = Category::create(['name' => 'Nghiên cứu Khoa học']);

        // 3. TẠO BÀI VIẾT MẪU (POSTS)
        // Bài 1: Của Admin viết
        Post::create([
            'title' => 'Việt Nam kiên quyết bảo vệ chủ quyền biển đảo',
            'summary' => 'Tại hội nghị quốc tế, đại diện Việt Nam khẳng định lập trường vững chắc...',
            'content' => 'Nội dung chi tiết bài viết về chủ quyền biển đảo...',
            'image' => null, // Chưa có ảnh thật thì để null
            'user_id' => $admin->id,
            'category_id' => $cat1->id,
            'created_at' => now(),
        ]);

        // Bài 2: Của BTV viết
        Post::create([
            'title' => 'Ngư dân Quảng Ngãi trúng đậm mùa cá ngừ',
            'summary' => 'Hàng trăm tàu cá cập cảng với khoang đầy ắp cá ngừ đại dương...',
            'content' => 'Nội dung chi tiết về ngư dân bám biển...',
            'image' => null,
            'user_id' => $btv->id,
            'category_id' => $cat2->id,
            'created_at' => now()->subDay(), // Đăng hôm qua
        ]);

        // Bài 3: Của BTV viết
        Post::create([
            'title' => 'Triển khai dự án điện gió ngoài khơi Bình Thuận',
            'summary' => 'Dự án năng lượng tái tạo lớn nhất khu vực vừa được khởi công...',
            'content' => 'Nội dung chi tiết về điện gió...',
            'image' => null,
            'user_id' => $btv->id,
            'category_id' => $cat2->id,
            'created_at' => now()->subDays(2), // Đăng 2 ngày trước
        ]);

        // 4. TẠO THÔNG BÁO MẪU (DOCUMENTS)
        DB::table('documents')->insert([
            [
                'title' => 'Lịch tiếp công dân tháng 02/2026',
                'link' => '#',
                'is_new' => true,
                'created_at' => now(),
            ],
            [
                'title' => 'Quyết định phê duyệt quy hoạch vùng ven biển',
                'link' => 'https://monre.gov.vn',
                'is_new' => false,
                'created_at' => now()->subDays(5),
            ],
            [
                'title' => 'Thông báo tuyển dụng viên chức Cục Biển đảo',
                'link' => '#',
                'is_new' => true,
                'created_at' => now(),
            ]
        ]);
    }
}