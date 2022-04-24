<?php

declare(strict_types=1);

namespace App\Service\Maker;

use App\Entity\Maker;
use App\Exception\Maker\MakerAlreadyExistException;
use App\Repository\MakerRepository;
use Doctrine\ORM\ORMException;

class MakerCreateService
{
    private MakerRepository $makerRepository;

    public function __construct(MakerRepository $makerRepository)
    {
        $this->makerRepository = $makerRepository;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(string $name): Maker
    {
        $maker = new Maker($name);
        try {
            $this->makerRepository->save($maker);
        } catch (\Exception $e) {
            throw MakerAlreadyExistException::fromName($name);
        }

        return $maker;
    }
}
