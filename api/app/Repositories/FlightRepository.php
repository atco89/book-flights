<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FlightRepository extends Repository
{

    /**
     * @param array|null $attributes
     * @param array $relations
     * @return Collection
     */
    public function filter(array|null $attributes, array $relations = []): Collection
    {
        $builder = self::builder($relations);

        if (!empty($attributes['departure'])) {
            $builder->whereHas('departureAirport',
                fn(Builder $builder): Builder => $builder->where('code', $attributes['departure'])
                    ->orWhere('name', 'like', "%{$attributes['departure']}%"));
        }

        if (!empty($attributes['arrival'])) {
            $builder->whereHas('arrivalAirport',
                fn(Builder $builder): Builder => $builder->where('code', $attributes['arrival'])
                    ->orWhere('name', 'like', "%{$attributes['arrival']}%"));
        }

        if (!empty($attributes['airline'])) {
            $builder->whereHas('airline',
                fn(Builder $builder): Builder => $builder->where('code', $attributes['airline']));
        }

        return $builder->get();
    }
}
