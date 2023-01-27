<?php

namespace Database\Seeders;

use App\Models\Aircraft;
use Illuminate\Database\Seeder;

class AircraftsSeeder extends Seeder
{

    /**
     * @noinspection PhpUndefinedMethodInspection
     */
    public function run(): void
    {
        $records = json_decode(file_get_contents(__DIR__ . '/../../storage/seed-data/aircrafts.json'), true);
        array_walk($records, fn(array $record) => Aircraft::create($record));
    }
}
