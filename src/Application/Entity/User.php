<?php

declare(strict_types=1);

namespace App\Application\Entity;

use App\Domain\User\Entity\User as BaseUser;
use Stringable;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends BaseUser implements UserInterface, EquatableInterface, Stringable
{
    public bool $equalTo = false;

    public function isEqualTo(UserInterface $user): bool
    {
        return $user->getUsername() === $this->getUsername();
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
