<?php

declare(strict_types=1);

namespace App\Exception\Model;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ModelNotFoundException extends NotFoundHttpException
{

    public static function fromModelId(string $id): self
    {
        throw new self(\sprintf('Modelo con id %s no encontrado', $id));
    }
}
