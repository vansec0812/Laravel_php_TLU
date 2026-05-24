<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoiThatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('noithat')->insert(
            [
                ['TenNoiThat' => 'Nồi'],
                ['TenNoiThat' => 'Chảo'],
                ['TenNoiThat' => 'Tủ lạnh'],
            ]
            );
    }
}
