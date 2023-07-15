<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('manufactures')->insert([
            [
                'nama'=>'Lainnya',
            ],
            [
                'nama'=>'PT. TERA DISTI INDONESIA',
            ],
            [
                'nama'=>'PT. ANUGRAH PRATAMA LOGISTIK',
            ],
        ]);
    }
}