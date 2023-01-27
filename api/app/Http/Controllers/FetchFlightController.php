<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Services\FlightService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchFlightController extends Controller
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
     * @throws NotFoundException
     * @noinspection PhpUndefinedFieldInspection
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->flightService->findByUid($request->flightUid, [
            'airline.country',
            'aircraft',
            'departureAirport.city.country',
            'arrivalAirport.city.country',
            'tickets.travelClass',
        ]));
    }
}
