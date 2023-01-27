<?php

namespace Database\Seeders;

use App\Models\FlightTicket;
use Illuminate\Database\Seeder;

class FlightTicketSeeder extends Seeder
{

    /**
     * @noinspection PhpUndefinedMethodInspection
     */
    public function run(): void
    {
        $records = json_decode(file_get_contents(__DIR__ . '/../../storage/seed-data/flight-tickets.json'), true);
        array_walk($records, fn(array $record) => FlightTicket::create($record));
    }
}
