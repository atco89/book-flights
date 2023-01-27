<?php

namespace Database\Seeders;

use App\Models\FlightStatus;
use Illuminate\Database\Seeder;

class FlightStatusesSeeder extends Seeder
{

    /**
     * @noinspection PhpUndefinedMethodInspection
     */
    public function run(): void
    {
        $records = json_decode(file_get_contents(__DIR__ . '/../../storage/seed-data/flight-statuses.json'), true);
        array_walk($records, fn(array $record) => FlightStatus::create($record));
    }
}
