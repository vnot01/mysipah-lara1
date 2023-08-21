<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ManufactureSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(NasabahSeeder::class);
        $this->call(TempCardSeeder::class);
        $this->call(TempVolSeeder::class);
        $this->call(StatusAlatSeeder::class);
        $this->call(ProcessingSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(ProcessingStatusSeeder::class);
        \App\Models\User::factory(5)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}