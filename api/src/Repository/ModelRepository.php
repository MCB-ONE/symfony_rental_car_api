<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Model;
use App\Exception\Model\ModelNotFoundException;

class ModelRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Model::class;
    }

    public function findOneById(string $id): Model
    {
        if (null === $model = $this->objectRepository->findOneBy(['id' => $id])) {
            throw ModelNotFoundException::fromModelId($id);
        }

        return $model;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Model $model): void
    {
        $this->saveEntity($model);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Model $model): void
    {
        $this->removeEntity($model);
    }
}
