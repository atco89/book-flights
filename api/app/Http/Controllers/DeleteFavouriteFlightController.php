<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Services\UserFavouriteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteFavouriteFlightController extends Controller
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
     * @throws NotFoundException
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userFavouriteService->delete($request->flightTicketUid));
    }
}
