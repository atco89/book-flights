<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Models\UserFlight;
use App\Repositories\UserFlightRepository;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class UserFlightService extends Service
{

    /**
     * @param UserFlightRepository $repository
     */
    public function __construct(UserFlightRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return UserFlight
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): UserFlight
    {
        $this->validate($input, $this->createRules());

        $userFlight = new UserFlight();
        $userFlight->fill($input)->saveOrFail();

        return $userFlight;
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
     * @return UserFlight
     * @throws BadRequestException
     * @throws Throwable
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function modify(string|null $uid, array|null $input): UserFlight
    {
        $userFlight = $this->findByTicketId($uid);

        $this->validate($input, $this->updateRules($userFlight));
        $userFlight->fill($input)->updateOrFail();

        return $userFlight->load([
            'ticket.flight.airline.country',
            'ticket.flight.aircraft',
            'ticket.flight.departureAirport.city.country',
            'ticket.flight.arrivalAirport.city.country',
            'ticket.travelClass',
            'flightStatus',
        ]);
    }

    /**
     * @param string|null $flightTicketUid
     * @param array $relations
     * @return UserFlight
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function findByTicketId(string|null $flightTicketUid, array $relations = []): UserFlight
    {
        return $this->repository->findByTicketId($flightTicketUid, $relations);
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
     * @param string|null $flightTicketUid
     * @return UserFlight
     * @throws Throwable
     * @noinspection PhpUndefinedFieldInspection
     */
    public function book(string|null $flightTicketUid): UserFlight
    {
        $userFlight = new UserFlight();
        $userFlight->flight_ticket_id = $flightTicketUid;
        $userFlight->saveOrFail();
        return $userFlight->load([
            'ticket.flight.airline.country',
            'ticket.flight.aircraft',
            'ticket.flight.departureAirport.city.country',
            'ticket.flight.arrivalAirport.city.country',
            'ticket.travelClass',
            'flightStatus',
        ]);
    }
}
