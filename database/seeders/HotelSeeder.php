<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Real hotel names sourced from various locations
        $hotels = [
            [
                'name' => 'Hotel Bel-Air',
                'address' => '701 Stone Canyon Road',
                'telephone' => '+1 310-472-1211',
                'email' => 'info@hotelbelair.com',
                'city' => 'Los Angeles',
                'rating' => 5,
                'image' => 'https://example.com/hotel-bel-air.jpg',

                'user_id' => rand(1,5), // Random user_id from 0 to 9
                'type_hotel_id' => 1, // Example: Type Hotel: City Hotel
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Ritz-Carlton New York, Central Park',
                'address' => '50 Central Park S',
                'telephone' => '+1 212-308-9100',
                'email' => 'centralpark@ritzcarlton.com',
                'city' => 'New York',
                'rating' => 5,
                'image' => 'https://example.com/ritz-carlton-nyc.jpg',

                'user_id' => rand(1,5), // Random user_id from 0 to 9
                'type_hotel_id' => 2, // Example: Type Hotel: Residential Hotel
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Marina Bay Sands',
                'address' => '10 Bayfront Avenue',
                'telephone' => '+65 6688 8888',
                'email' => 'info@marinabaysands.com',
                'city' => 'Singapore',
                'rating' => 5,
                'image' => 'https://example.com/marina-bay-sands.jpg',

                'user_id' => rand(1,5), // Random user_id from 0 to 9

                'type_hotel_id' => 3, // Example: Type Hotel: Motel
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Peninsula Paris',
                'address' => '19 Avenue Kléber',
                'telephone' => '+33 1 58 12 28 88',
                'email' => 'ppr@peninsula.com',
                'city' => 'Paris',
                'rating' => 5,
                'image' => 'https://example.com/peninsula-paris.jpg',

                'user_id' => rand(1,5), // Random user_id from 0 to 9
                'type_hotel_id' => 1, // Example: Type Hotel: City Hotel
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Four Seasons Hotel Sydney',
                'address' => '199 George St',
                'telephone' => '+61 2 9250 3100',
                'email' => 'sydney@fourseasons.com',
                'city' => 'Sydney',
                'rating' => 5,
                'image' => 'https://example.com/four-seasons-sydney.jpg',

                'user_id' => rand(1,5), // Random user_id from 0 to 9

                'type_hotel_id' => 2, // Example: Type Hotel: Residential Hotel
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Atlantis The Palm, Dubai',
                'address' => 'Crescent Rd - The Palm Jumeirah',
                'telephone' => '+971 4 426 2000',
                'email' => 'info@atlantisthepalm.com',
                'city' => 'Dubai',
                'rating' => 5,
                'image' => 'https://example.com/atlantis-dubai.jpg',

                'user_id' => rand(1,5), // Random user_id from 0 to 9
                'type_hotel_id' => 3, // Example: Type Hotel: Motel
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hotel Splendido',
                'address' => 'Salita Baratta, 16',
                'telephone' => '+39 0185 267801',
                'email' => 'info@hotelsplendido.com',
                'city' => 'Portofino',
                'rating' => 5,
                'image' => 'https://example.com/hotel-splendido.jpg',

                'user_id' => rand(1,5), // Random user_id from 0 to 9
                'type_hotel_id' => 1, // Example: Type Hotel: City Hotel
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more hotels as needed
        ];

        // Insert the hotels into the database
        DB::table('hotels')->insert($hotels);
    }
}
