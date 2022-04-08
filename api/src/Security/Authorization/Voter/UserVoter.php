<?php

declare(strict_types=1);

namespace App\Security\Authorization\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Esta configuración de seguridad es para establecer que un usuario solo va a poder leer, editar o borrar SUS PROPIOS DATOS.
 */
class UserVoter extends Voter
{
    public const USER_READ = 'USER_READ';
    public const USER_UPDATE = 'USER_UPDATE';
    public const USER_DELETE = 'USER_DELETE';

    protected function supports(string $attribute, $subject): bool
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param User|null $subject
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if (\in_array($attribute, $this->supportedAttributes(), true)) {
            return $subject->equals($token->getUser());
        }

        return false;
    }

    private function supportedAttributes(): array
    {
        return [
            self::USER_READ,
            self::USER_UPDATE,
            self::USER_DELETE,
        ];
    }
}
