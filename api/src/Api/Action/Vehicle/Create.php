<?php

declare(strict_types=1);

namespace App\Api\Action\Vehicle;

use App\Entity\Vehicle;
use App\Service\Request\RequestService;
use App\Service\Vehicle\VehicleCreateService;
use Symfony\Component\HttpFoundation\Request;

class Create
{
    private VehicleCreateService $vehicleCreateService;

    public function __construct(VehicleCreateService $vehicleCreateService)
    {
        $this->vehicleCreateService = $vehicleCreateService;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request): Vehicle
    {
        dump(RequestService::getField($request, 'model'));
        return $this->vehicleCreateService->create(
            RequestService::getField($request, 'plateNumber'),
            RequestService::getField($request, 'modelYear'),
            RequestService::getField($request, 'model'),
        );
    }
}
