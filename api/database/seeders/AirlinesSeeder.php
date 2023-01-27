<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;

class AirlinesSeeder extends Seeder
{

    /**
     * @noinspection PhpUndefinedMethodInspection
     */
    public function run(): void
    {
        $records = json_decode(file_get_contents(__DIR__ . '/../../storage/seed-data/airlines.json'), true);
        array_walk($records, fn(array $record) => Airline::create($record));
    }
}
