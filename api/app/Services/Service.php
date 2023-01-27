<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\NotFoundException;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator as v;
use Illuminate\Validation\Validator;

abstract class Service implements ServiceInterface
{

    /**
     * @param Repository $repository
     */
    public function __construct(
        protected Repository $repository,
    )
    {
    }

    /**
     * @param array $relations
     * @return Collection
     */
    public function findAll(array $relations = []): Collection
    {
        return $this->repository->findAll($relations);
    }

    /**
     * @param array|null $attributes
     * @param array $relations
     * @return Collection
     */
    public function filter(array|null $attributes, array $relations = []): Collection
    {
        return $this->repository->filter($attributes, $relations);
    }

    /**
     * @param int|null $id
     * @param array $relations
     * @return Model
     * @throws NotFoundException
     */
    public function findById(int|null $id, array $relations = []): Model
    {
        return $this->repository->findById($id);
    }

    /**
     * @param string|null $uid
     * @param array $relations
     * @return Model
     * @throws NotFoundException
     */
    public function findByUid(string|null $uid, array $relations = []): Model
    {
        return $this->repository->findByUid($uid, $relations);
    }

    /**
     * @param string|null $uid
     * @return void
     * @throws NotFoundException
     */
    public function delete(string|null $uid): void
    {
        $this->repository->delete($uid);
    }

    /**
     * @param array $attributes
     * @param array $rules
     * @return void
     * @throws BadRequestException
     */
    protected function validate(array $attributes, array $rules): void
    {
        $validator = $this->validator($attributes, $rules);
        if ($validator->fails()) {
            throw new BadRequestException($validator->errors()->toJson());
        }
    }

    /**
     * @param array|null $attributes
     * @param array $rules
     * @return Validator
     */
    public function validator(array|null $attributes, array $rules): Validator
    {
        return v::make($attributes, $rules);
    }
}
