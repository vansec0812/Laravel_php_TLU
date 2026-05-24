<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NguoidungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nguoidung')->insert([
            [
                'TenNguoiDung' => 'Nguyễn Văn An',
                'GioiTinh' => 'Nam',
                'DiaChi' => 'Quận 1, TP.HCM',
                'DienThoai' => '0901234567',
                'Email' => 'nguyenvanan@gmail.com',
                'ID' => 1,
            ],
            [
                'TenNguoiDung' => 'Trần Thị Bình',
                'GioiTinh' => 'Nu',
                'DiaChi' => 'Quận 3, TP.HCM',
                'DienThoai' => '0912345678',
                'Email' => 'tranthitinh@gmail.com',
                'ID' => 2,
            ],
            [
                'TenNguoiDung' => 'Lê Minh Cường',
                'GioiTinh' => 'Nam',
                'DiaChi' => 'Quận Ba Đình, Hà Nội',
                'DienThoai' => '0923456789',
                'Email' => 'leminhcuong@gmail.com',
                'ID' => 3,
            ],
            [
                'TenNguoiDung' => 'Phạm Ngọc Dung',
                'GioiTinh' => 'Nu',
                'DiaChi' => 'Quận Hải Châu, Đà Nẵng',
                'DienThoai' => '0934567890',
                'Email' => 'phamngocdung@gmail.com',
                'ID' => 4,
            ],
            [
                'TenNguoiDung' => 'Hoàng Đức Em',
                'GioiTinh' => 'Nam',
                'DiaChi' => 'Quận Cầu Giấy, Hà Nội',
                'DienThoai' => '0945678901',
                'Email' => 'hoangducem@gmail.com',
                'ID' => 5,
            ],
            [
                'TenNguoiDung' => 'Vũ Thanh Phúc',
                'GioiTinh' => 'Nam',
                'DiaChi' => 'Quận 7, TP.HCM',
                'DienThoai' => '0956789012',
                'Email' => 'vuthanhphuc@gmail.com',
                'ID' => 6,
            ],
            [
                'TenNguoiDung' => 'Đặng Thị Giang',
                'GioiTinh' => 'Nu',
                'DiaChi' => 'TP. Cần Thơ',
                'DienThoai' => '0967890123',
                'Email' => 'dangthigiang@gmail.com',
                'ID' => 7,
            ],
            [
                'TenNguoiDung' => 'Bùi Quốc Hải',
                'GioiTinh' => 'Nam',
                'DiaChi' => 'Quận Bình Thạnh, TP.HCM',
                'DienThoai' => '0978901234',
                'Email' => 'buiquochai@gmail.com',
                'ID' => 8,
            ],
            [
                'TenNguoiDung' => 'Ngô Xuân Lan',
                'GioiTinh' => 'Nu',
                'DiaChi' => 'TP. Huế, Thừa Thiên Huế',
                'DienThoai' => '0989012345',
                'Email' => 'ngoxuanlan@gmail.com',
                'ID' => 9,
            ],
            [
                'TenNguoiDung' => 'Phan Hữu Khoa',
                'GioiTinh' => 'Nam',
                'DiaChi' => 'TP. Nha Trang, Khánh Hòa',
                'DienThoai' => '0990123456',
                'Email' => 'phanhuukhoa@gmail.com',
                'ID' => 10,
            ],
        ]);
    }
}
