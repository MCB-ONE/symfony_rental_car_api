<?php

declare(strict_types=1);

namespace App\Exception\Vehicle;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class VehicleAlreadyExistException extends ConflictHttpException
{
    private const MESSAGE = 'El vehículo con mátricula %s ya existe';

    public static function fromPlateNumber(string $plateNumber): self
    {
        throw new self(\sprintf(self::MESSAGE, $plateNumber));
    }
}
