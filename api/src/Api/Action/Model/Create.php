<?php

declare(strict_types=1);

namespace App\Api\Action\Model;

use App\Entity\Model;
use App\Service\Request\RequestService;
use App\Service\Model\ModelCreateService;
use Symfony\Component\HttpFoundation\Request;

class Create
{
    private ModelCreateService $modelCreateService;

    public function __construct(ModelCreateService $modelCreateService)
    {
        $this->modelCreateService = $modelCreateService;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request): Model
    {
        return $this->modelCreateService->create(
            RequestService::getField($request, 'name'),
            RequestService::getField($request, 'overview'),
            RequestService::getField($request, 'pricePerDay'),
            RequestService::getField($request, 'fuelType'),
            RequestService::getField($request, 'seatingCapacity'),
            RequestService::getField($request, 'image'),
            RequestService::getField($request, 'gearSystem')
        );
    }
}
