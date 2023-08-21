<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('processing_statuses')->insert([
            [
                'processing_id'=>'7',
                'products_id'=>'1',
                'vol'=>'0.5',
                'status'=>'0',
                'created_at'=>Carbon::now(),
            ],
        ]);
    }
}
