<?php

namespace App\Http\Controllers;

use App\Services\FlightService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchAllFlightsController extends Controller
{

    /**
     * @param FlightService $flightService
     */
    public function __construct(
        protected FlightService $flightService
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->flightService->filter($request->all(), [
            'airline.country',
            'aircraft',
            'departureAirport.city.country',
            'arrivalAirport.city.country',
            'tickets.travelClass',
        ]));
    }
}
