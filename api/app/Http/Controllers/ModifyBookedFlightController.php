<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Services\UserFlightService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ModifyBookedFlightController extends Controller
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
     * @throws BadRequestException|NotFoundException|Throwable
     * @noinspection PhpUndefinedFieldInspection
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userFlightService->modify($request->flightTicketUid, $request->all()));
    }
}
