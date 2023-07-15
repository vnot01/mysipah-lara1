<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                'nama'=>'Lainnya',
            ],
            [
                'nama'=>'Arang',
            ],
            [
                'nama'=>'Asap Cair',
            ],
            [
                'nama'=>'Listrik',
            ],
            [
                'nama'=>'Pyrolysis Oil',
            ],
        ]);
    }
}
