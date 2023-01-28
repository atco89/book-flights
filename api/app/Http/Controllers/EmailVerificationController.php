<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * @return RedirectResponse
     * @throws Throwable
     * @noinspection PhpUndefinedFieldInspection
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $this->userService->verifyEmail($request->activationCode);
        return response()->redirectTo('http://localhost:4200/account-activation');
    }
}
