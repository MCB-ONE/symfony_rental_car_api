<?php

declare(strict_types=1);

namespace App\Exception\Maker;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MakerNotFoundException extends NotFoundHttpException
{

    public static function fromMakerId(string $id): self
    {
        throw new self(\sprintf('Fabricante con id %s no encontrado', $id));
    }
}
