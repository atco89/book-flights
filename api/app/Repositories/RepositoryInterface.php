<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    /**
     * @param string $column
     * @param mixed $value
     * @param array $relations
     * @return Model
     */
    public static function findByColumn(string $column, mixed $value, array $relations = []): Model;

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
     * @return void
     */
    public function delete(string|null $uid): void;
}
