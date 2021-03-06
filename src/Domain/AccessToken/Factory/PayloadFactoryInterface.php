<?php

declare(strict_types=1);

namespace App\Domain\AccessToken\Factory;

use App\Domain\AccessToken\Payload;
use App\Domain\AuthToken\Entity\AuthToken;
use Doctrine\Common\Collections\Collection;

interface PayloadFactoryInterface
{
    public function create(AuthToken $token): Payload;

    /**
     * @param Collection<string> $scopes
     */
    public function createDirect(string $username, Collection $scopes): Payload;
}
