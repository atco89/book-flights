<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{

    /**
     * @return array
     */
    public function createRules(): array;

    /**
     * @param Model $model
     * @return array
     */
    public function updateRules(Model $model): array;

    /**
     * @param array|null $input
     * @return Model
     */
    public function save(array|null $input): Model;

    /**
     * @param array $relations
     * @return Collection
     */
    public function findAll(array $relations = []): Collection;

    /**
     * @param array|null $attributes
     * @param array $relations
     * @return Collection
     */
    public function filter(array|null $attributes, array $relations = []): Collection;

    /**
     * @param int|null $id
     * @param array $relations
     * @return Model
     */
    public function findById(int|null $id, array $relations = []): Model;

    /**
     * @param string|null $uid
     * @param array $relations
     * @return Model
     */
    public function findByUid(string|null $uid, array $relations = []): Model;

    /**
     * @param string|null $uid
     * @param array|null $input
     * @return Model
     */
    public function modify(string|null $uid, array|null $input): Model;

    /**
     * @param string|null $uid
     * @return void
     */
    public function delete(string|null $uid): void;
}
