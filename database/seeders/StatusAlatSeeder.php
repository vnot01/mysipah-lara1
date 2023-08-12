<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusAlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('status_alats')->insert([
            [
                'kode'=>'1',
                'nama'=>'Register',
            ],
            [
                'kode'=>'2',
                'nama'=>'Scanning',
            ],
        ]);
    }
}