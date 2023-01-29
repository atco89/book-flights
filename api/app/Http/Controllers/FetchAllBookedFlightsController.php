<?php

namespace App\Http\Controllers;

use App\Services\UserFlightService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchAllBookedFlightsController extends Controller
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
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userFlightService->findAll([
            'user',
            'ticket.flight.airline.country',
            'ticket.flight.aircraft',
            'ticket.flight.departureAirport.city.country',
            'ticket.flight.arrivalAirport.city.country',
            'ticket.travelClass',
            'flightStatus',
        ]));
    }
}
