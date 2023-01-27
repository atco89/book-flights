<?php

namespace App\Http\Controllers;

use App\Services\UserFlightService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchBookedFlightController extends Controller
{


    /**
     * @param UserFlightService $userFlightService
     */
    public function __construct(
        protected UserFlightService $userFlightService,
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @noinspection PhpUndefinedFieldInspection
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userFlightService->findByTicketId($request->flightTicketUid, [
            'ticket.flight.airline.country',
            'ticket.flight.aircraft',
            'ticket.flight.departureAirport.city.country',
            'ticket.flight.arrivalAirport.city.country',
            'ticket.travelClass',
            'flightStatus',
        ]));
    }
}
