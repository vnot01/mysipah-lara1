<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('locations')->insert([
            [
                // https://developers.google.com/maps/documentation/javascript/examples/event-click-latlng
                'nama'=>'Gudang 1',
                'lat'=>'-7.840485851790767',
                'long'=>'110.3541778466545',
            ]
        ]);
    }
}
