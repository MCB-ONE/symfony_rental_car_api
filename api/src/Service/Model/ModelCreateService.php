<?php

declare(strict_types=1);

namespace App\Service\Model;

use App\Entity\Model;
use App\Exception\Model\ModelAlreadyExistException;
use App\Repository\ModelRepository;
use Doctrine\ORM\ORMException;

class ModelCreateService
{
    private ModelRepository $modelRepository;

    public function __construct(ModelRepository $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(
        string $name,
        ?string $overview,
        float $pricePerDay,
        int $stock,
        bool $availabilityFlag,
        string $fuelType,
        int $seatingCapacity,
        ?string $image,
        string $gearSystem
    ): Model
    {
        $model = new Model(
            $name,
            $overview,
            $pricePerDay,
            $stock,
            $availabilityFlag,
            $fuelType,
            $seatingCapacity,
            $image,
            $gearSystem
        );

        try {
            $this->vehicleRepository->save($model);
        } catch (\Exception $e) {
            throw ModelAlreadyExistException::fromName($name);
        }

        return $model;
    }
}
