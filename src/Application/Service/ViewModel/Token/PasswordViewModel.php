<?php

declare(strict_types=1);

namespace App\Application\Service\ViewModel\Token;

use App\Application\Http\Request\DTO\AccessToken\PasswordRequest;
use App\Application\Service\ViewModel\Token\View\TokenModel;
use App\Application\Service\ViewModel\ViewInterface;
use App\Domain\AccessToken\AccessTokenService;
use App\Domain\AccessToken\Factory\PayloadFactoryInterface;
use App\Domain\RefreshToken\RefreshTokenService;
use App\Infrastructure\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Webmozart\Assert\Assert;

final class PasswordViewModel
{
    private PayloadFactoryInterface $payloadFactory;
    private AccessTokenService $tokenEncrypter;
    private RefreshTokenService $refreshTokenManager;
    private UserPasswordEncoderInterface $userPasswordEncoder;
    private UserRepository $userRepository;

    public function __construct(
        PayloadFactoryInterface $payloadFactory,
        AccessTokenService $tokenEncrypter,
        RefreshTokenService $refreshTokenManager,
        UserPasswordEncoderInterface $userPasswordEncoder,
        UserRepository $userRepository
    ) {
        $this->payloadFactory = $payloadFactory;
        $this->tokenEncrypter = $tokenEncrypter;
        $this->refreshTokenManager = $refreshTokenManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->userRepository = $userRepository;
    }

    public function createView(PasswordRequest $request): ViewInterface
    {
        /** @var UserInterface $user */
        $user = $this->userRepository->findOneByName($request->username);

        Assert::notNull($user, 'User not found');
        Assert::true(
            $this->userPasswordEncoder->isPasswordValid($user, $request->password),
            'Invalid credentials',
        );

        $payload = $this->payloadFactory->createDirect($user->getUsername(), $request->getScopes());

        return new TokenModel(
            $this->tokenEncrypter->encode($payload),
            $payload->expires,
            $this->refreshTokenManager->createToken($user)->getToken(),
        );
    }
}
