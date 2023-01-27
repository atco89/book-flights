<?php

namespace App\Http\Controllers;

use App\Exceptions\BadRequestException;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class SignUpController extends Controller
{

    /**
     * @param UserService $userService
     */
    public function __construct(
        protected UserService $userService,
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws BadRequestException|Throwable
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userService->save($request->all()), 201);
    }
}
