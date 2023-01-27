<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserFavouriteRepository extends Repository
{

    /**
     * @param array $relations
     * @return Collection
     */
    public function findAll(array $relations = []): Collection
    {
        return self::builder($relations)->whereHas('user',
            fn(Builder $builder): Builder => $builder->where('id', Auth::id()))->get();
    }
}
