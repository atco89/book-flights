<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{

    /**
     * @noinspection PhpUndefinedMethodInspection
     */
    public function run(): void
    {
        $records = json_decode(file_get_contents(__DIR__ . '/../../storage/seed-data/countries.json'), true);
        array_walk($records, fn(array $record) => Country::create($record));
    }
}
