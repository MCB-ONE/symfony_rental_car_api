<?php

declare(strict_types=1);

namespace App\Service\Model;

use App\Entity\Maker;
use App\Entity\Model;
use App\Exception\Model\ModelAlreadyExistException;
use App\Repository\MakerRepository;
use App\Repository\ModelRepository;
use Doctrine\ORM\ORMException;

class ModelCreateService
{
    private ModelRepository $modelRepository;
    private MakerRepository $makerRepository;

    public function __construct(ModelRepository $modelRepository, MakerRepository $makerRepository)
    {
        $this->modelRepository = $modelRepository;
        $this->makerRepository = $makerRepository;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(
        string $name,
        ?string $overview,
        float $pricePerDay,
        string $fuelType,
        int $seatingCapacity,
        ?string $image,
        string $gearSystem,
        string $makerIri,
        string $categoryIri
    ): Model {
        $makerId = explode("/", $makerIri);
        $maker = $this->makerRepository->findOneById($makerId[4]);

        $categoryId = explode("/", $categoryIri);
        $category = $this->categoryRepository->findOneById($categoryId[4]);

        $model = new Model(
            $name,
            $overview,
            $pricePerDay,
            $fuelType,
            $seatingCapacity,
            $image,
            $gearSystem,
            $maker,
            $category
        );

        try {
            $this->modelRepository->save($model);
        } catch (\Exception $e) {
            throw ModelAlreadyExistException::fromName($name);
        }

        return $model;
    }
}
