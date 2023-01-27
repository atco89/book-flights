<?php

namespace App\Http\Controllers;

use App\Services\UserFavouriteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchAllFavouriteFlightsController extends Controller
{

    /**
     * @param UserFavouriteService $userFavouriteService
     */
    public function __construct(
        protected UserFavouriteService $userFavouriteService
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userFavouriteService->findAll([
            'flight.airline.country',
            'flight.aircraft',
            'flight.departureAirport.city.country',
            'flight.arrivalAirport.city.country',
            'flight.tickets.travelClass',
        ]));
    }
}
