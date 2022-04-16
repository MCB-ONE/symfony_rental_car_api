<?php

declare(strict_types=1);

namespace App\Exception\Vehicle;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VehicleNotFoundException extends NotFoundHttpException
{

    public static function fromVehicleId(string $id): self
    {
        throw new self(\sprintf('Vehículo con id %s no encontrado', $id));
    }

    public static function fromPlateNumber(string $plateNumber): self
    {
        throw new self(\sprintf('Vehículo con mátricula %s no encontrado', $plateNumber));
    }
}
