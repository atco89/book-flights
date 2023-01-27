<?php

namespace Database\Seeders;

use App\Models\TravelClass;
use Illuminate\Database\Seeder;

class TravelClassesSeeder extends Seeder
{

    /**
     * @noinspection PhpUndefinedMethodInspection
     */
    public function run(): void
    {
        $records = json_decode(file_get_contents(__DIR__ . '/../../storage/seed-data/travel-classes.json'), true);
        array_walk($records, fn(array $record) => TravelClass::create($record));
    }
}
