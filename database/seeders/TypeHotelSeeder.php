<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeHotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_hotels')
            ->insert(
                [
                    [
                        'name' => "City Hotel"
                    ],
                    [
                        'name' => "Residential Hotel"

                    ],
                    [
                        'name' => "Motel"
                    ]
                ]
            );
    }
}
