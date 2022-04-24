<?php

declare(strict_types=1);

namespace App\Api\Action\Model;

use App\Entity\Model;
use App\Service\Model\UploadImageService;
use Symfony\Component\HttpFoundation\Request;

class UploadImage
{
    private UploadImageService $uploadImageService;

    public function __construct(UploadImageService $uploadImageService)
    {
        $this->uploadImageService = $uploadImageService;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(Request $request, string $id): Model
    {
        dump($id);
        return $this->uploadImageService->uploadImage($request, $id);
    }
}
