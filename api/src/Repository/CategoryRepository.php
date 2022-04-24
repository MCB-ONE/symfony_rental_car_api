<?php

namespace App\Repository;

use App\Entity\Category;
use App\Exception\Category\CategoryNotFoundException;

class CategoryRepository extends BaseRepository
{
    protected static function entityClass(): string
    {
        return Category::class;
    }

    public function findOneById(string $id): Category
    {

        if (null === $category = $this->objectRepository->findOneBy(['id' => $id])) {
            throw CategoryNotFoundException::fromCategoryId($id);
        }

        return $category;
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(Category $category): void
    {
        $this->saveEntity($category);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Category $category): void
    {
        $this->removeEntity($category);
    }
}
