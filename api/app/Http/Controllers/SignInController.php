<?php

namespace App\Http\Controllers;

use App\Exceptions\UnauthenticatedException;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class SignInController extends Controller
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
     * @throws Throwable|UnauthenticatedException
     */
    public function __invoke(Request $request): JsonResponse
    {
        $token = $this->userService->signIn($request->all());
        return response()->json(compact('token'));
    }
}
