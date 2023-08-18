<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventories')->insert([
            [
                // 'products_id'=>'1',
                'types_id'=>'1',
                // 'photo'=>'Lainnya',
                'volume'=>'10.5',
                // 'ukuran'=>'Lainnya',
                // 'jumlah_produk'=>'Lainnya',
            ],
        ]);
    }
}
