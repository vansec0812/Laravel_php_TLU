<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VatLieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('vatlieu')->insert(
            [
                ['TenVatLieu' => 'Thép'],
                ['TenVatLieu' => 'Bê tông'],
                ['TenVatLieu' => 'Gạch'],
            ]
            );

    }
}
