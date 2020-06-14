<?php declare(strict_types=1);

namespace App\Domain\Service\Token\Factory;

use App\Domain\Entity\AuthToken;
use App\Domain\Entity\Scope;
use App\Domain\Service\Token\Payload;
use DateTime;

class PayloadFactory implements PayloadFactoryInterface
{
    public function create(AuthToken $token): Payload
    {
        return new Payload(
            $token->getUser()->getUsername(),
            (new DateTime('+10 minutes'))->getTimestamp(),
            $token->getClient()->getScopes()->map(fn(Scope $scope) => $scope->getName())->toArray(),
        );
    }
}
