<?php

declare(strict_types=1);

namespace App\Exception\Maker;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class MakerAlreadyExistException extends ConflictHttpException
{
    private const MESSAGE = 'El fabricante de vehículo %s ya existe';

    public static function fromName(string $name): self
    {
        throw new self(\sprintf(self::MESSAGE, $name));
    }
}
