<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('types')->insert([
            [
                'nama'=>'Lainnya',
            ],
            [
                'nama'=>'Organik',
            ],
            [
                'nama'=>'Plastik',
            ],
            [
                'nama'=>'Kertas',
            ],
            [
                'nama'=>'Karet',
            ],
            [
                'nama'=>'Bahan Logam',
            ],
            [
                'nama'=>'Kaca',
            ],
            [
                'nama'=>'Kaleng',
            ],
        ]);
    }
}
