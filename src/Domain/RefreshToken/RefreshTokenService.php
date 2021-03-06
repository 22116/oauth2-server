<?php

declare(strict_types=1);

namespace App\Domain\RefreshToken;

use App\Domain\RefreshToken\Contract\RefreshTokenRepositoryInterface;
use App\Domain\RefreshToken\Entity\RefreshToken;
use App\Domain\Scope\Contract\ScopeRepositoryInterface;
use App\Domain\Shared\Contract\DateTimeInterface;
use App\Domain\Shared\Contract\HashGeneratorInterface;
use App\Domain\User\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class RefreshTokenService
{
    private HashGeneratorInterface $hashGenerator;
    private DateTimeInterface $dateTime;
    private ScopeRepositoryInterface $scopeRepository;
    private RefreshTokenRepositoryInterface $refreshTokenRepository;

    public function __construct(
        HashGeneratorInterface $hashGenerator,
        DateTimeInterface $dateTime,
        ScopeRepositoryInterface $scopeRepository,
        RefreshTokenRepositoryInterface $refreshTokenRepository
    ) {
        $this->hashGenerator = $hashGenerator;
        $this->dateTime = $dateTime;
        $this->scopeRepository = $scopeRepository;
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    public function createToken(User $user, ?ArrayCollection $scopes = null): RefreshToken
    {
        $token = new RefreshToken(
            $this->hashGenerator->generate(),
            $this->dateTime->getDate(),
            $user,
            $scopes ?? $this->scopeRepository->findDefaults(),
        );

        $this->refreshTokenRepository->save($token);

        return $token;
    }
}
