<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DocTyperSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          DB::table('_doc_types')->insert(
            [
                ['Name_DocType' => 'Toán'],
                ['Name_DocType' => 'Văn'],
                ['Name_DocType' => 'Anh'],
            ]
            );
    }
}
