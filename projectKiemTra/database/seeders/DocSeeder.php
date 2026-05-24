<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('_docs')->insert(
            [
                ['Name_Doc' => 'Toán lớp 1','Author' => "Nguyễn Văn An",'Des' => "GDPT",'Id_DocType' => 1],
                ['Name_Doc' => 'Toán lớp 11','Author' => "Nguyễn Thanh Thảo",'Des' => "THPT",'Id_DocType' => 2],
                ['Name_Doc' => 'Toán lớp 12','Author' => "Trần Văn Bình",'Des' => "THPT",'Id_DocType' => 3],
            ]
        );
    }
}
