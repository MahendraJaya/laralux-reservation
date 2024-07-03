<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define exchange rate for conversion (1 USD = 14,000 IDR)
        $exchangeRate = 16000;

        // Define products data using real hotel IDs and type product IDs
        $products = [
            [
                'name' => "Standard Room",
                'price' => 150 * $exchangeRate, // Example price in IDR
                'capacity' => 2,
                'image' => 'https://example.com/standard-room.jpg',
                'available_room' => 10,
                'hotel_id' => 1, // Example hotel_id corresponding to Hotel Bel-Air
                'type_product_id' => 1
            ],
            [
                'name' => 'Deluxe Suite',
                'price' => 300 * $exchangeRate, // Example price in IDR
                'capacity' => 4,
                'image' => 'https://example.com/deluxe-suite.jpg',
                'available_room' => 5,
                'hotel_id' => 2, // Example hotel_id corresponding to The Ritz-Carlton New York, Central Park
                'type_product_id' => 2
            ],
            [
                'name' => 'Superior Room',
                'price' => 200 * $exchangeRate, // Example price in IDR
                'capacity' => 2,
                'image' => 'https://example.com/superior-room.jpg',
                'available_room' => 8,
                'hotel_id' => 3, // Example hotel_id corresponding to Marina Bay Sands
                'type_product_id' => 3
            ],
            [
                'name' => 'Single Room',
                'price' => 120 * $exchangeRate, // Example price in IDR
                'capacity' => 1,
                'image' => 'https://example.com/single-room.jpg',
                'available_room' => 12,
                'hotel_id' => 4, // Example hotel_id corresponding to The Peninsula Paris
                'type_product_id' => 4
            ],
            [
                'name' => 'Double Room',
                'price' => 180 * $exchangeRate, // Example price in IDR
                'capacity' => 2,
                'image' => 'https://example.com/double-room.jpg',
                'available_room' => 7,
                'hotel_id' => 5, // Example hotel_id corresponding to Four Seasons Hotel Sydney
                'type_product_id' => 5
            ],
            [
                'name' => 'Family Suite',
                'price' => 400 * $exchangeRate, // Example price in IDR
                'capacity' => 6,
                'image' => 'https://example.com/family-suite.jpg',
                'available_room' => 3,
                'hotel_id' => 6, // Example hotel_id corresponding to Atlantis The Palm, Dubai
                'type_product_id' => 6
            ],
            [
                'name' => 'Luxury Suite',
                'price' => 500 * $exchangeRate, // Example price in IDR
                'capacity' => 4,
                'image' => 'https://example.com/luxury-suite.jpg',
                'available_room' => 4,
                'hotel_id' => 7, // Example hotel_id corresponding to Hotel Splendido
                'type_product_id' => 1 // Example: Type Product: Standard (assigning the same as an example)

            ],
            [
                'name' => 'Presidential Suite',
                'price' => 800 * $exchangeRate, // Example price in IDR
                'capacity' => 8,
                'image' => 'https://example.com/presidential-suite.jpg',
                'available_room' => 2,
                'hotel_id' => 4, // Example hotel_id corresponding to Burj Al Arab Jumeirah
                'type_product_id' => 2 // Example: Type Product: Deluxe
            ],
            [
                'name' => 'Ocean View Room',
                'price' => 250 * $exchangeRate, // Example price in IDR
                'capacity' => 2,
                'image' => 'https://example.com/ocean-view-room.jpg',
                'available_room' => 6,
                'hotel_id' => 6, // Example hotel_id corresponding to Bora Bora Pearl Beach Resort & Spa
                'type_product_id' => 3
            ],
            [
                'name' => 'Mountain View Suite',
                'price' => 350 * $exchangeRate, // Example price in IDR
                'capacity' => 4,
                'image' => 'https://example.com/mountain-view-suite.jpg',
                'available_room' => 5,
                'hotel_id' => 7, // Example hotel_id corresponding to The Chedi Andermatt
                'type_product_id' => 5
            ]
            // Add more products as needed
        ];

        // Insert the products into the database
        DB::table('products')->insert($products);
    }
}
