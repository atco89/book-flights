<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Exceptions\NotVerifiedEmailException;
use App\Exceptions\UnauthenticatedException;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Throwable;

class UserService extends Service
{

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param array|null $input
     * @return User
     * @throws BadRequestException|Throwable
     */
    public function save(array|null $input): User
    {
        $this->validate($input, $this->createRules());

        $user = new User();
        $user->fill($input)->saveOrFail();
        $user->sendEmailVerificationNotification();

        return $user;
    }

    /**
     * @return array
     */
    public function createRules(): array
    {
        return [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'birth_date' => 'required|date',
            'passport_number' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
        ];
    }

    /**
     * @param string|null $uid
     * @param array|null $input
     * @return User
     * @throws BadRequestException|NotFoundException|Throwable
     */
    public function modify(string|null $uid, array|null $input): User
    {
        /** @var User $user */
        $user = $this->findByUid($uid);

        $this->validate($input, $this->updateRules($user));
        $user->fill($input)->updateOrFail();

        return $user;
    }

    /**
     * @param Model $model
     * @return string[]
     * @noinspection PhpUndefinedFieldInspection
     */
    public function updateRules(Model $model): array
    {
        return [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'birth_date' => 'required|date',
            'passport_number' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,' . $model->id,
        ];
    }

    /**
     * @param string|null $activationCode
     * @return void
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     * @throws Throwable
     */
    public function verifyEmail(string|null $activationCode): void
    {
        /** @var User $user */
        $user = $this->repository->findByVerificationCode($activationCode);
        if ($user->hasVerifiedEmail()) {
            return;
        }
        $user->markEmailAsVerified();
    }

    /**
     * @param array|null $input
     * @return string
     * @throws UnauthenticatedException
     * @throws NotVerifiedEmailException
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function signIn(array|null $input): string
    {
        $token = Auth::attempt($input);
        if (!Auth::user()->hasVerifiedEmail()) {
            throw new NotVerifiedEmailException();
        }

        if (!$token) {
            throw new UnauthenticatedException();
        }
        return $token;
    }

    /**
     * @return void
     */
    public function singOut(): void
    {
        Auth::logout();
    }
}
