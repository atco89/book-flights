<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\City;
use App\Repositories\CityRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class CityService extends Service
{

    /**
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return City
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): City
    {
        $this->validate($input, $this->createRules());

        $city = new City();
        $city->fill($input)->saveOrFail();

        return $city;
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
     * @return City
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): City
    {
        /** @var City $city */
        $city = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($city));
        $city->fill($input)->updateOrFail();

        return $city;
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
