<?php

declare(strict_types=1);

namespace App\Service\Vehicle;

use App\Entity\Model;
use App\Entity\Vehicle;
use App\Exception\Vehicle\VehicleAlreadyExistException;
use App\Repository\ModelRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\ORMException;

class VehicleCreateService
{
    private VehicleRepository $vehicleRepository;
    private ModelRepository $modelRepository;

    public function __construct(VehicleRepository $vehicleRepository, ModelRepository $modelRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
        $this->modelRepository = $modelRepository;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(
        string $plateNumber,
        string $modelId,
        bool $availabilityFlag = true,
        int $registrationYear
    ): Vehicle {

        $model = $this->modelRepository->findOneById($modelId);
        dump($model);
        $vehicle = new Vehicle($plateNumber, $model, $availabilityFlag, $registrationYear);

        try {
            $this->vehicleRepository->save($vehicle);
        } catch (\Exception $e) {
            throw VehicleAlreadyExistException::fromPlateNumber($plateNumber);
        }

        return $vehicle;
    }
}
