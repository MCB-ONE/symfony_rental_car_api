<?php

declare(strict_types=1);

namespace App\Exception\Model;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ModelAlreadyExistException extends ConflictHttpException
{
    private const MESSAGE = 'El modelo de vehículo %s ya existe';

    public static function fromName(string $name): self
    {
        throw new self(\sprintf(self::MESSAGE, $name));
    }
}
