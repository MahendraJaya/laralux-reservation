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
        $table_names = ['products', 'hotels', 'type_products', 'type_hotels'];
        foreach($table_names as $table_name){
            DB::table($table_name)->delete();
            DB::statement('ALTER TABLE '.$table_name.' AUTO_INCREMENT = 1;');

        }
        
        $this->call([
            UserSeeder::class,
            TypeHotelSeeder::class,
            TypeProductSeeder::class,
            HotelSeeder::class,
            ProductSeeder::class
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
