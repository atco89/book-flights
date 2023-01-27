<?php

namespace App\Http\Controllers;

use App\Services\AirportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FetchAllAirports extends Controller
{

    /**
     * @param AirportService $airportService
     */
    public function __construct(
        protected AirportService $airportService
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->airportService->findAll(['city.country']));
    }
}
