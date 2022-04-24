<?php

declare(strict_types=1);

namespace App\Api\Action\Maker;

use App\Entity\Maker;
use App\Service\Maker\MakerCreateService;
use App\Service\Request\RequestService;
use Symfony\Component\HttpFoundation\Request;

class Create
{
    private MakerCreateService $makerCreateService;

    public function __construct(MakerCreateService $makerCreateService)
    {
        $this->makerCreateService = $makerCreateService;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request): Maker
    {
        return $this->makerCreateService->create(
            RequestService::getField($request, 'name')
        );
    }
}
