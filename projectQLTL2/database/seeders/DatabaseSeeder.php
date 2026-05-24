<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed tài liệu trước (vì nguoidung có foreign key tới tailieu1)
        $this->call([
            Tailieu1Seeder::class,
            NguoidungSeeder::class,
        ]);
    }
}
