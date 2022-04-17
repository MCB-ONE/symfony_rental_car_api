<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Vehicle
{
    private string $id;
    private string $plateNumber;
    private int $modelYear;
    private Model $model;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(
        string $plateNumber,
        int $modelYear,
        Model $model
    )
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->plateNumber = $plateNumber;
        $this->modelYear = $modelYear;
        $this->model = $model;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    
    public function getId(): string
    {
        return $this->id;
    }

    public function getPlateNumber(): string
    {
        return $this->plateNumber;
    }

    public function setPlateNumber(string $plateNumber): void
    {
        $this->plateNumber = $plateNumber;
    }

    public function getModelYear(): int
    {
        return $this->modelYear;
    }

    public function setModelYear(int $modelYear): void
    {
        $this->modelYear = $modelYear;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }


}
