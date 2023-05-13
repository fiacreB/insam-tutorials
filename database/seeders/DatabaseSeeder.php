<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'InsamTutoras',
            'email' => 'iueinsamtutoras@gmail.com',
            'email_verified_at' => '2023-01-11 13:40:44',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'is_super_admin' => '1',
        ]);
    }
}
