<?php

declare(strict_types=1);

namespace App\Service\Vehicle;

use App\Entity\Vehicle;
use App\Exception\Vehicle\VehicleAlreadyExistException;
use App\Repository\VehicleRepository;
use Doctrine\ORM\ORMException;

class VehicleCreateService
{
    private VehicleRepository $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(string $plateNumber, int $modelYear): Vehicle
    {
        $vehicle = new Vehicle($plateNumber, $modelYear);

        try {
            $this->vehicleRepository->save($vehicle);
        } catch (ORMException $e) {
            throw VehicleAlreadyExistException::fromPlateNumber($plateNumber);
        }

        return $vehicle;
    }
}
