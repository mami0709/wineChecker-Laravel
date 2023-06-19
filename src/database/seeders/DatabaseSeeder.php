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
        // ResultAkaTableSeederを読み込むように指定
        $this->call(ResultAkaTableSeeder::class);
        $this->call(ResultShiroWinesTableSeeder::class);
        $this->call(RecommendsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
