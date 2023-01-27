<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\Aircraft;
use App\Repositories\AircraftRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class AircraftService extends Service
{

    /**
     * @param AircraftRepository $repository
     */
    public function __construct(AircraftRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return Aircraft
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): Aircraft
    {
        $this->validate($input, $this->createRules());

        $aircraft = new Aircraft();
        $aircraft->fill($input)->saveOrFail();

        return $aircraft;
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
     * @return Aircraft
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): Aircraft
    {
        /** @var Aircraft $aircraft */
        $aircraft = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($aircraft));
        $aircraft->fill($input)->updateOrFail();

        return $aircraft;
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
