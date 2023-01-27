<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\TravelClass;
use App\Repositories\TravelClassRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class TravelClassService extends Service
{

    /**
     * @param TravelClassRepository $repository
     */
    public function __construct(TravelClassRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return TravelClass
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): TravelClass
    {
        $this->validate($input, $this->createRules());

        $travelClass = new TravelClass();
        $travelClass->fill($input)->saveOrFail();

        return $travelClass;
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
     * @return TravelClass
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): TravelClass
    {
        /** @var TravelClass $travelClass */
        $travelClass = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($travelClass));
        $travelClass->fill($input)->updateOrFail();

        return $travelClass;
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
