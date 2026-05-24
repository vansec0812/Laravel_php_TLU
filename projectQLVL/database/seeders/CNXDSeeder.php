<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CNXDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('cnxd')->insert(
            [
                ['Name' => 'Lê Quang Trường','GioiTinh' => "Nam",'Email' => "a@gmail.com",'ID' => 1],
                ['Name' => 'Lê Quang Trung','GioiTinh' => "Nam",'Email' => "b@gmail.com",'ID' => 2],
                ['Name' => 'Lê Quang Huy','GioiTinh' => "Nam",'Email' => "c@gmail.com",'ID' => 3],
            ]
        );
    }
}
