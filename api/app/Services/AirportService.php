<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\Airport;
use App\Repositories\AirportRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class AirportService extends Service
{

    /**
     * @param AirportRepository $repository
     */
    public function __construct(AirportRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return Airport
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): Airport
    {
        $this->validate($input, $this->createRules());

        $airport = new Airport();
        $airport->fill($input)->saveOrFail();

        return $airport;
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
     * @return Airport
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): Airport
    {
        /** @var Airport $airport */
        $airport = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($airport));
        $airport->fill($input)->updateOrFail();

        return $airport;
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
