<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Vehicle;
use App\Exception\Vehicle\VehicleNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class VehicleRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Vehicle::class;
    }

    public function findOneById(string $id): Vehicle
    {
        if (null === $vehicle = $this->objectRepository->findOneBy(['id' => $id])) {
            throw VehicleNotFoundException::fromVehicleId($id);
        }

        return $vehicle;
    }

    public function findOneByPlateNumber(string $plateNumber): Vehicle
    {
        if (null === $vehicle = $this->objectRepository->findOneBy(['email' => $plateNumber])) {
            throw VehicleNotFoundException::fromPlateNumber($plateNumber);
        }

        return $vehicle;
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Vehicle $vehicle): void
    {
        $this->saveEntity($vehicle);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Vehicle $vehicle): void
    {
        $this->removeEntity($vehicle);
    }
}
