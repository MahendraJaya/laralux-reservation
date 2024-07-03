<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_products')
        ->insert(
            [
                ['name'=>'Standar'],
                ['name'=>'Deluxe'],
                ['name'=>'Superior'],
                ['name'=>'Single Room'],
                ['name'=>'Double Room'],
                ['name'=>'Family Room'],


            ]
        );
    }
}
