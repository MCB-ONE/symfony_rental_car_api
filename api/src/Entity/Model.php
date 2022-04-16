<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class Model
{
    private string $id;
    private string $name;
    private ?string $overview;
    private float $pricePerDay;
    private int $stock;
    private bool $availabilityFlag;
    private string $fuelType;
    private int $seatingCapacity;
    private ?string $image;
    private string $gearSystem;
    private ?Brand $brand;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(
         string $name,
         ?string $overview,
         float $pricePerDay,
         int $stock,
         bool $availabilityFlag = true,
         string $fuelType,
         int $seatingCapacity,
         ?string $image,
         string $gearSystem
    )
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->overview = $overview;
        $this->pricePerDay = $pricePerDay;
        $this->stock = $stock;
        $this->availabilityFlag = $availabilityFlag;
        $this->fuelType = $fuelType;
        $this->seatingCapacity = $seatingCapacity;
        $this->image = $image;
        $this->gearSystem = $gearSystem;
        $this->brand = null;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
    }

    
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    
    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): void
    {
        $this->overview = $overview;
    }

    public function getPricePerDay(): float
    {
        return $this->pricePerDay;
    }

    public function setStock(float $stock): void
    {
        $this->stock = $stock;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setPricePerDay(int $pricePerDay): void
    {
        $this->pricePerDay = $pricePerDay;
    }

    public function getFuelType(): string
    {
        return $this->fuelType;
    }

    public function setFuelType(string $fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    public function getAvailabilityFlag(): ?bool
    {
        return $this->availabilityFlag;
    }

    public function setAvailabilityFlag(?bool $availabilityFlag): void
    {
        $this->availabilityFlag = $availabilityFlag;
    }

    public function getSeatingCapacity(): int
    {
        return $this->seatingCapacity;
    }

    public function setSeatingCapacity(int $seatingCapacity): void
    {
        $this->seatingCapacity = $seatingCapacity;
    }

    public function getGearSystem(): string
    {
        return $this->gearSystem;
    }

    public function setGearSystem(string $gearSystem): void
    {
        $this->gearSystem = $gearSystem;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
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


    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): void
    {
        $this->brand = $brand;
    }


}
