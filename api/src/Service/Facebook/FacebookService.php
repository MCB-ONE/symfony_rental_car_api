<?php

declare(strict_types=1);

namespace App\Service\Facebook;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use App\Http\FacebookClient;
use App\Repository\UserRepository;
use App\Service\Password\EncoderService;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class FacebookService
{
    private const ENDPOINT = '/me?fields=name,email';

    private FacebookClient $facebookClient;
    private UserRepository $userRepository;
    private EncoderService $encoderService;
    private JWTTokenManagerInterface $JWTTokenManager;

    public function __construct(
        FacebookClient $facebookClient,
        UserRepository $userRepository,
        EncoderService $encoderService,
        JWTTokenManagerInterface $JWTTokenManager
    ) {
        $this->facebookClient = $facebookClient;
        $this->userRepository = $userRepository;
        $this->encoderService = $encoderService;
        $this->JWTTokenManager = $JWTTokenManager;
    }

    /**
     * @throws FacebookSDKException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function authorize(string $accessToken)
    {
        try {
            $response = $this->facebookClient->get(self::ENDPOINT, $accessToken);
        } catch (\Exception $e) {
            throw new BadRequestHttpException(\sprintf('Error de Facebook. Mensaje: %s', $e->getMessage()));
        }

        $graphUser = $response->getGraphUser();

        // Comporobar si el usuario tiene email asociado en Facebook, ya que Facebook permite crear una cuenta solo con un núm de teléfono
        if (null === $email = $graphUser->getEmail()) {
            throw new BadRequestHttpException('La cuenta de Facebook no tiene un email asociado');
        }

        try {
            $user = $this->userRepository->findOneByEmailOrFail($email);
        } catch (UserNotFoundException $e) {
            $user = $this->createUser($graphUser->getName(), $email);
        }

        return $this->JWTTokenManager->create($user);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    private function createUser(string $name, string $email): User
    {
        $user = new User($name, $email);
        $user->setPassword($this->encoderService->generateEncodedPassword($user, \sha1(\uniqid())));
        $user->setActive(true);
        $user->setToken(null);

        $this->userRepository->save($user);

        return $user;
    }
}
