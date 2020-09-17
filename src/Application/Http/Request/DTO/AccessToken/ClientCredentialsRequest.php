<?php

declare(strict_types=1);

namespace App\Application\Http\Request\DTO\AccessToken;

use App\Domain\Scope\Entity\Scope;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use LSBProject\RequestBundle\Configuration\RequestStorage;
use LSBProject\RequestBundle\Request\AbstractRequest;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @RequestStorage({"body"})
 */
class ClientCredentialsRequest extends AbstractRequest
{
    const GRANT_TYPE = 'client_credentials';

    /**
     * @Assert\EqualTo(self::GRANT_TYPE)
     */
    public string $grantType;
    public string $scope = Scope::INFO;

    /**
     * @return Collection<string>
     */
    public function getScopes(): Collection
    {
        return new ArrayCollection(array_map('trim', explode(',', $this->scope)));
    }
}
