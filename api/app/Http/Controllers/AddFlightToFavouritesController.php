<?php

namespace App\Http\Controllers;

use App\Services\UserFavouriteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AddFlightToFavouritesController extends Controller
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
     * @noinspection PhpUndefinedFieldInspection
     * @noinspection PhpUnhandledExceptionInspection
     * @throws Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userFavouriteService->addToFavourite($request->flightTicketUid));
    }
}
