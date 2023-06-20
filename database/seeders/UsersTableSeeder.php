<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            [
                'name'=>'Administrator',
                'username'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('f3rifeb'),
                'photo'=>'admin.jpg',
                'status'=>'active',
                'role'=>'admin'
            ],
            [
                'name'=>'Gudang',
                'username'=>'warehouse',
                'email'=>'warehouse@gmail.com',
                'password'=>Hash::make('f3rifeb'),
                'photo'=>'no_image.jpg',
                'status'=>'active',
                'role'=>'warehouse'
            ],
            [
                'name'=>'Operator',
                'username'=>'operator',
                'email'=>'operator@gmail.com',
                'password'=>Hash::make('f3rifeb'),
                'photo'=>'no_image.jpg',
                'status'=>'active',
                'role'=>'operator'
            ],
            [
                'name'=>'User',
                'username'=>'user',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('f3rifeb'),
                'photo'=>'no_image.jpg',
                'status'=>'active',
                'role'=>'user'
            ]
        ]);
    }
}