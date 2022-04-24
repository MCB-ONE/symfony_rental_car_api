<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Maker
{

    private string $id;
    private string $name;
    private Collection $models;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(string $name)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->createdAt = new \DateTime();
        $this->markAsUpdated();
        $this->models = new ArrayCollection();
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

        /**
     * @return ArrayCollection|Collection
     */
    public function getModels() 
    {
        return $this->models;
    }

    public function addModel(Model $model): void
    {
        if (!$this->models->contains($model)){
            $this->models->add($model);
        }

    }

    public function removeModel(Model $model): void
    {
        if ($this->models->contains($model)){
            $this->models->removeElement($model);
        }
    }

}
