<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\Flight;
use App\Repositories\FlightRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class FlightService extends Service
{

    /**
     * @param FlightRepository $repository
     */
    public function __construct(FlightRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return Flight
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): Flight
    {
        $this->validate($input, $this->createRules());

        $flight = new Flight();
        $flight->fill($input)->saveOrFail();

        return $flight;
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
     * @return Flight
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): Flight
    {
        /** @var Flight $flight */
        $flight = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($flight));
        $flight->fill($input)->updateOrFail();

        return $flight;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function updateRules(Model $model): array
    {
        return [];
    }
}
