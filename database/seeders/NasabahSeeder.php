<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('nasabahs')->insert([
            [
                'users_id'=>'1',
                'nokartu'=>'XXXXXXXXXXX',
            ],
            [
                'users_id'=>'5',
                'nokartu'=>'81601992109',
            ],
        ]);
    }
}
