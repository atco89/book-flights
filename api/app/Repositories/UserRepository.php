<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{

    /**
     * @param string|null $activationCode
     * @param array|null $relations
     * @return User|Model
     * @throws NotFoundException
     */
    public function findByVerificationCode(string|null $activationCode, array|null $relations = []): User|Model
    {
        $model = self::builder($relations)->where('verification_code', $activationCode)->first();
        if ($model instanceof Model) {
            return $model;
        }
        throw new NotFoundException();
    }
}
