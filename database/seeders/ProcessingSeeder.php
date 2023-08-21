<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessingSeeder extends Seeder
{
    // $table->unsignedBigInteger('sources_id')->nullable()->default(1);
    //         $table->unsignedBigInteger('types_id')->nullable()->default(1);
    //         $table->unsignedBigInteger('manufactures_id')->nullable()->default(1);
    //         $table->unsignedBigInteger('locations_id')->nullable()->default(1);
    //         $table->string('volume')->nullable();
    //         $table->string('total_volume')->nullable();
    //         $table->string('photo')->nullable();
    //         $table->enum('remark', ['in','out','warehouse'])
    //             ->nullable()->default('in');
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('processings')->insert([
            [
                'sources_id'=>'1',
                'types_id'=>'1',
                'manufactures_id'=>'1',
                // 'inventories_id'=>'1',
                'volume'=>'3.5',
                'total_volume'=>'3.5',
                'remark'=>'warehouse',
                'created_at'=>Carbon::now(),
            ],
            [
                'sources_id'=>'2',
                'types_id'=>'1',
                'manufactures_id'=>'2',
                // 'inventories_id'=>'1',
                'volume'=>'3.5',
                'total_volume'=>'7',
                'remark'=>'warehouse',
                'created_at'=>Carbon::now(),
            ],
            [
                'sources_id'=>'3',
                'types_id'=>'1',
                'manufactures_id'=>'3',
                // 'inventories_id'=>'1',
                'volume'=>'1',
                'total_volume'=>'8',
                'remark'=>'warehouse',
                'created_at'=>Carbon::now(),
            ],
            [
                'sources_id'=>'4',
                'types_id'=>'1',
                'manufactures_id'=>'3',
                // 'inventories_id'=>'1',
                'volume'=>'2',
                'total_volume'=>'10',
                'remark'=>'warehouse',
                'created_at'=>Carbon::now(),
            ],
            [
                'sources_id'=>'5',
                'types_id'=>'1',
                'manufactures_id'=>'2',
                // 'inventories_id'=>'1',
                'volume'=>'0.5',
                'total_volume'=>'10.5',
                'remark'=>'warehouse',
                'created_at'=>Carbon::now(),
            ],
            [
                'sources_id'=>'5',
                'types_id'=>'2',
                'manufactures_id'=>'2',
                // 'inventories_id'=>'1',
                'volume'=>'0.5',
                'total_volume'=>'10.5',
                'remark'=>'in',
                'created_at'=>Carbon::now(),
            ],
            [
                'sources_id'=>'1',
                'types_id'=>'1',
                'manufactures_id'=>'2',
                // 'inventories_id'=>'1',
                'volume'=>'0.5',
                'total_volume'=>'10',
                'remark'=>'out',
                'created_at'=>Carbon::now(),
            ],
        ]);
    }
}