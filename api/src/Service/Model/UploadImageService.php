<?php

declare(strict_types=1);

namespace App\Service\Model;

use App\Entity\Model;
use App\Repository\ModelRepository;
use App\Service\File\FileService;
use Symfony\Component\HttpFoundation\Request;

class UploadImageService
{
    private ModelRepository $modelRepository;
    private FileService $fileService;
    private string $mediaPath;

    public function __construct(ModelRepository $modelRepository, FileService $fileService, string $mediaPath)
    {
        $this->modelRepository = $modelRepository;
        $this->fileService = $fileService;
        $this->mediaPath = $mediaPath;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function uploadImage(Request $request, string $id): Model
    {
        dump($id);
        $model = $this->modelRepository->findOneById($id);
        dump($model);
        $file = $this->fileService->validateFile($request, FileService::MODEL_INPUT_NAME);

        $this->fileService->deleteFile($model->getImage());

        $fileName = $this->fileService->uploadFile($file, FileService::MODEL_INPUT_NAME);

        $model->setImage($fileName);

        $this->modelRepository->save($model);

        return $model;
    }
}
