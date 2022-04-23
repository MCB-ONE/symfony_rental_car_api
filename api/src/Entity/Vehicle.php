<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Vehicle
{
    private string $id;
    private string $plateNumber;
    private Model $model;
    private bool $availabilityFlag;
    private int $registrationYear;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(
        string $plateNumber,
        Model $model,
        bool $availabilityFlag = true,
        int $registrationYear
    )
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->plateNumber = $plateNumber;
        $this->model = $model;
        $this->availabilityFlag = $availabilityFlag;
        $this->registrationYear = $registrationYear;
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

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function getavAilabilityFlag(): bool
    {
        return $this->availabilityFlag;
    }

    public function setAvailabilityFlag(bool $availabilityFlag): void
    {
        $this->availabilityFlag = $availabilityFlag;
    }

    public function getRegistrationYear(): int
    {
        return $this->registrationYear;
    }

    public function setRegistrationYear(int $registrationYear): void
    {
        $this->registrationYear = $registrationYear;
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

    public function toArray(): array {
        return [
            'id' => $this->id,
            'plateNumber' => $this->plateNumber,
            'registrationYear' => $this->registrationYear,
        ];
    }


}
