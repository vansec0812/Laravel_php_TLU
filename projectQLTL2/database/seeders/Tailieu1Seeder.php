<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tailieu1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tailieu1')->insert([
            ['TenTaiLieu' => 'Giáo trình Lập trình Web'],
            ['TenTaiLieu' => 'Giáo trình Cơ sở dữ liệu'],
            ['TenTaiLieu' => 'Giáo trình Mạng máy tính'],
            ['TenTaiLieu' => 'Sách Cấu trúc dữ liệu và giải thuật'],
            ['TenTaiLieu' => 'Tài liệu Hệ điều hành'],
            ['TenTaiLieu' => 'Báo cáo Đồ án tốt nghiệp'],
            ['TenTaiLieu' => 'Tài liệu Phân tích thiết kế hệ thống'],
            ['TenTaiLieu' => 'Giáo trình Lập trình Java'],
            ['TenTaiLieu' => 'Sách Trí tuệ nhân tạo'],
            ['TenTaiLieu' => 'Tài liệu An toàn thông tin'],
        ]);
    }
}
