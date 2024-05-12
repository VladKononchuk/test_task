<?php

namespace AppBundle\Repository\Owner;

use AppBundle\Entity\Owner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class OwnerRepository extends ServiceEntityRepository implements OwnerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Owner::class);
    }

    public function save(Owner $automobile): void
    {
        $this->_em->persist($automobile);
        $this->_em->flush();
    }
}