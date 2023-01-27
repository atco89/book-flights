<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(CountriesSeeder::class);
        $this->call(AirlinesSeeder::class);
        $this->call(TravelClassesSeeder::class);
        $this->call(FlightStatusesSeeder::class);
        $this->call(CitiesSeeder::class);
        $this->call(AirportsSeeder::class);
        $this->call(AircraftsSeeder::class);
        $this->call(FlightsSeeder::class);
        $this->call(FlightTicketSeeder::class);
    }
}
