<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class EmailVerificationController extends Controller
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
     * @param EmailVerificationRequest $request
     * @return Response
     * @throws Throwable
     * @noinspection PhpUndefinedFieldInspection
     */
    public function __invoke(Request $request): Response
    {
        $this->userService->verifyEmail($request->activationCode);
        return response()->noContent(200);
    }
}
