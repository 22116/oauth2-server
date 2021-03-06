<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Shared\Contract\PersistenceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @template T
 * @extends ServiceEntityRepository<T>
 */
abstract class PersistenceRepository extends ServiceEntityRepository implements PersistenceRepositoryInterface
{
    public function save(object $object): void
    {
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush($object);
    }

    public function remove(object $object): void
    {
        $this->getEntityManager()->remove($object);
    }
}
