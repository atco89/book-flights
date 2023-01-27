<?php

namespace App\Http\Controllers;

use App\Services\UserFlightService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class BookFlightController extends Controller
{

    /**
     * @param UserFlightService $userFlightService
     */
    public function __construct(
        protected UserFlightService $userFlightService
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @noinspection PhpUndefinedFieldInspection
     * @throws Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userFlightService->book($request->flightTicketUid));
    }
}
