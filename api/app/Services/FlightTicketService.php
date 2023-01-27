<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Models\FlightTicket;
use App\Repositories\FlightTicketRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class FlightTicketService extends Service
{

    /**
     * @param FlightTicketRepository $repository
     */
    public function __construct(FlightTicketRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return FlightTicket
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): FlightTicket
    {
        $this->validate($input, $this->createRules());

        $flightPrice = new FlightTicket();
        $flightPrice->fill($input)->saveOrFail();

        return $flightPrice;
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
     * @return FlightTicket
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): FlightTicket
    {
        /** @var FlightTicket $flightPrice */
        $flightPrice = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($flightPrice));
        $flightPrice->fill($input)->updateOrFail();

        return $flightPrice;
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
