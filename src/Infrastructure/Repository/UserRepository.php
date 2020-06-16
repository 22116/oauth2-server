<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
final class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $username
     * @return User|null|object
     */
    public function findOneByName(string $username): ?User
    {
        return $this->findOneBy([
            'username' => $username,
        ]);
    }
}
