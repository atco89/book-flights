<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\FlightStatus;
use App\Repositories\FlightStatusRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class FlightStatusService extends Service
{

    /**
     * @param FlightStatusRepository $repository
     */
    public function __construct(FlightStatusRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return FlightStatus
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): FlightStatus
    {
        $this->validate($input, $this->createRules());

        $flightStatus = new FlightStatus();
        $flightStatus->fill($input)->saveOrFail();

        return $flightStatus;
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
     * @return FlightStatus
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): FlightStatus
    {
        /** @var FlightStatus $flightStatus */
        $flightStatus = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($flightStatus));
        $flightStatus->fill($input)->updateOrFail();

        return $flightStatus;
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
