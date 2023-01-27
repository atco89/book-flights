<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use ReflectionClass;

abstract class Repository implements RepositoryInterface
{

    /**
     * @param string $column
     * @param mixed $value
     * @param array $relations
     * @return Model
     * @throws NotFoundException
     */
    public static function findByColumn(string $column, mixed $value, array $relations = []): Model
    {
        $model = self::builder($relations)->where($column, $value)->first();
        if ($model instanceof Model) {
            return $model;
        }
        throw new NotFoundException();
    }

    /**
     * @param array $relations
     * @return Builder
     */
    protected static function builder(array $relations = []): Builder
    {
        $reflection = new ReflectionClass(get_called_class());
        $repository = Str::ucsplit($reflection->getShortName());
        array_pop($repository);
        /** @var Model $model */
        $model = 'App\Models\\' . implode('', $repository);
        return $model::with($relations);
    }

    /**
     * @param array|null $attributes
     * @param array $relations
     * @return Collection
     */
    public function filter(array|null $attributes, array $relations = []): Collection
    {
        return $this->findAll($relations);
    }

    /**
     * @param array $relations
     * @return Collection
     */
    public function findAll(array $relations = []): Collection
    {
        return self::builder($relations)->get();
    }

    /**
     * @param int|null $id
     * @param array $relations
     * @return Model
     * @throws NotFoundException
     */
    public function findById(int|null $id, array $relations = []): Model
    {
        $model = self::builder($relations)->find($id);
        if ($model instanceof Model) {
            return $model;
        }
        throw new NotFoundException();
    }

    /**
     * @param string|null $uid
     * @return void
     * @throws NotFoundException
     */
    public function delete(string|null $uid): void
    {
        $this->findByUid($uid)->delete();
    }

    /**
     * @param string|null $uid
     * @param array $relations
     * @return Model
     * @throws NotFoundException
     */
    public function findByUid(string|null $uid, array $relations = []): Model
    {
        $model = self::builder($relations)->where('uid', $uid)->first();
        if ($model instanceof Model) {
            return $model;
        }
        throw new NotFoundException();
    }
}
