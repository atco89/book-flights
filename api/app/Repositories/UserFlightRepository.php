<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserFlightRepository extends Repository
{

    /**
     * @param array $relations
     * @return Collection
     */
    public function findAll(array $relations = []): Collection
    {
        return self::builder($relations)->where('user_id', Auth::id())->get();
    }

    /**
     * @param string|null $ticketUid
     * @param array $relations
     * @return Model
     * @throws NotFoundException
     */
    public function findByTicketId(string|null $ticketUid, array $relations = []): Model
    {
        $model = self::builder($relations)
            ->whereHas('ticket', fn(Builder $builder) => $builder->where('uid', $ticketUid))
            ->whereHas('user', fn(Builder $builder) => $builder->where('id', Auth::id()))
            ->first();
        if ($model instanceof Model) {
            return $model;
        }
        throw new NotFoundException();
    }
}
