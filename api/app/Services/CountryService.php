<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\Country;
use App\Repositories\CountryRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class CountryService extends Service
{

    /**
     * @param CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return Country
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): Country
    {
        $this->validate($input, $this->createRules());

        $country = new Country();
        $country->fill($input)->saveOrFail();

        return $country;
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
     * @return Country
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): Country
    {
        /** @var Country $country */
        $country = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($country));
        $country->fill($input)->updateOrFail();

        return $country;
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
