<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tables')->insert([
            ['table_number' => 1, 'seats' => 4],
            ['table_number' => 2, 'seats' => 6],
            ['table_number' => 3, 'seats' => 2],
            ['table_number' => 4, 'seats' => 8],
            ['table_number' => 5, 'seats' => 4],
        ]);
    }
}
