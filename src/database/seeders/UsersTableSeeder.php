<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'mail_address' => 'test@gmail.com',
            'user_password' => Hash::make('00000000'),
            'user_name' => 'テストユーザ',
            'user_name_hiragana' => 'てすとゆーざ',
            'telephone_number' => '0123456789',
            'nickname' => 'テス太',
            'created_at' => now(),
            'token' => 123456789,
        ]);
    }
}
