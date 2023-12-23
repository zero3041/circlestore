<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id_profile' => 1,
            'id_lang' => 1,
            'name' => 'But',
            'last_name' => 'Nguyen',
            'action' => 1,
            'phone_number' => '123456789',
            'email' => 'vietbut3004@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('vietbut123'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
