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
        \App\Models\User::factory(20)->create();
        
        $this->call(PermissionTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SessionSeeder::class);
        $this->call(AlmustawayatSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(AldafeuhSeeder::class);
        $this->call(PartsSeeder::class);
        
    }
}
