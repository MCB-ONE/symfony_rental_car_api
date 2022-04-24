<?php

declare(strict_types=1);

namespace App\Exception\Category;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryNotFoundException extends NotFoundHttpException
{

    public static function fromCategoryId(string $id): self
    {
        throw new self(\sprintf('Categoria con id %s no encontrado', $id));
    }
}
