<?php

declare(strict_types=1);

namespace App\Exception\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'User with email %s not found';

    public static function fromEmail(string $email): self
    {
        throw new self(\sprintf(self::MESSAGE, $email));
    }

    public static function fromUserIdAndToken(string $id, string $token): self
    {
        throw new self(\sprintf('Usuario con el id %s y token %s no encontrado', $id, $token));
    }

    public static function fromUserIdAndResetPasseordToken(string $id, string $resetPasswordToken): self
    {
        throw new self(\sprintf('Usuario con id %s y resetPasswordToken %s no encontrado', $id, $resetPasswordToken));
    }
}
