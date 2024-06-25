<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('users')
                ->insert(
                    [
                        'name' => Str::random(10),
                        'email' => Str::random(10) . '@gmail.com',
                        'password' => Hash::make('password'),
                        "role" => "pembeli"
                    ]
                );
        }

        DB::table('users')
            ->insert(
                [
                    'name' => "pembeli",
                    'email' => 'pembeli@gmail.com',
                    'password' => Hash::make('pembeli'),
                    "role" => "pembeli"
                ]
            );

        DB::table('users')
            ->insert(
                [
                    'name' => "staff",
                    'email' => 'staff@gmail.com',
                    'password' => Hash::make('staff'),
                    "role" => "staff"
                ]
            );

        DB::table('users')
            ->insert(
                [
                    'name' => "owner",
                    'email' => 'owner@gmail.com',
                    'password' => Hash::make('owner'),
                    "role" => "owner"
                ]
            );
    }
}
