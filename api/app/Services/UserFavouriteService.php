<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\UserFavourite;
use App\Repositories\UserFavouriteRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class UserFavouriteService extends Service
{

    /**
     * @param UserFavouriteRepository $repository
     */
    public function __construct(UserFavouriteRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return UserFavourite
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): UserFavourite
    {
        $this->validate($input, $this->createRules());

        $userFavourite = new UserFavourite();
        $userFavourite->fill($input)->saveOrFail();

        return $userFavourite;
    }

    /**
     * @return array
     */
    public function createRules(): array
    {
        return [];
    }

    /**
     * @param string|null $uid
     * @param array|null $input
     * @return UserFavourite
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): UserFavourite
    {
        /** @var UserFavourite $userFavourite */
        $userFavourite = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($userFavourite));
        $userFavourite->fill($input)->updateOrFail();

        return $userFavourite;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function updateRules(Model $model): array
    {
        return [];
    }

    /**
     * @param string|null $flightUid
     * @return UserFavourite
     * @throws Throwable
     * @noinspection PhpUndefinedFieldInspection
     */
    public function addToFavourite(string|null $flightUid): UserFavourite
    {
        $userFavourite = new UserFavourite();
        $userFavourite->flight_id = $flightUid;
        $userFavourite->saveOrFail();
        return $userFavourite->load([
            'flight.airline.country',
            'flight.aircraft',
            'flight.departureAirport.city.country',
            'flight.arrivalAirport.city.country',
            'flight.tickets',
        ]);
    }
}
