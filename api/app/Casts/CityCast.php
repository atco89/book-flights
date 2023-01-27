<?php

namespace App\Casts;

use App\Exceptions\NotFoundException;
use App\Repositories\CityRepository;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CityCast implements CastsAttributes
{

    /**
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return int
     */
    public function get($model, string $key, $value, array $attributes): int
    {
        return $value;
    }

    /**
     * @param $model
     * @param string $key
     * @param $value
     * @param array $attributes
     * @return int
     * @throws NotFoundException
     */
    public function set($model, string $key, $value, array $attributes): int
    {
        return CityRepository::findByColumn('uid', $value)->getKey();
    }
}
