<?php

namespace App\Repository;

use App\Entity\Maker;
use App\Exception\Maker\MakerNotFoundException;

class MakerRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Maker::class;
    }

    public function findOneById(string $id): Maker
    {

        if (null === $maker = $this->objectRepository->findOneBy(['id' => $id])) {
            throw MakerNotFoundException::fromMakerId($id);
        }

        return $maker;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Maker $maker): void
    {
        $this->saveEntity($maker);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Maker $maker): void
    {
        $this->removeEntity($maker);
    }
}
