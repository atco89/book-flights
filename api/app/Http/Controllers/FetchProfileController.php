<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class FetchProfileController extends Controller
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
     * @throws Throwable|NotFoundException
     * @noinspection PhpUndefinedFieldInspection
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json($this->userService->findByUid(Auth::user()->uid));
    }
}
