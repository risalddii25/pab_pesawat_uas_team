<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FlightsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('flights')->insert([
            [
                'flight_id' => 1,
                'flight_number' => 'FL123',
                'departure' => 'Jakarta',
                'destination' => 'Bali',
                'departure_time' => Carbon::now()->addDays(1),
                'arrival_time' => Carbon::now()->addDays(1)->addHours(2),
                'price' => 150.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'flight_id' => 2,
                'flight_number' => 'FL456',
                'departure' => 'Surabaya',
                'destination' => 'Yogyakarta',
                'departure_time' => Carbon::now()->addDays(2),
                'arrival_time' => Carbon::now()->addDays(2)->addHours(1),
                'price' => 100.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'flight_id' => 3,
                'flight_number' => 'FL789',
                'departure' => 'Medan',
                'destination' => 'Jakarta',
                'departure_time' => Carbon::now()->addDays(3),
                'arrival_time' => Carbon::now()->addDays(3)->addHours(3),
                'price' => 200.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
