<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class MyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass = '')
    {
        parent::__construct($registry, $entityClass);
    }

    /**
     * @param object $entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function save(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @param object $entity
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function findWithCertainty(string $id): object
    {
        $object = $this->find($id);
        if (null === $object) {
            throw new ResourceNotFoundException();
        }

        return $object;
    }
}
