<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\Airline;
use App\Repositories\AirlineRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class AirlineService extends Service
{

    /**
     * @param AirlineRepository $repository
     */
    public function __construct(AirlineRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return Airline
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): Airline
    {
        $this->validate($input, $this->createRules());

        $airline = new Airline();
        $airline->fill($input)->saveOrFail();

        return $airline;
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
     * @return Airline
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): Airline
    {
        /** @var Airline $airline */
        $airline = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($airline));
        $airline->fill($input)->updateOrFail();

        return $airline;
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
