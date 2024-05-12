<?php

namespace AppBundle\Repository\Automobile;

use AppBundle\Entity\Automobile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\OptimisticLockException;

final class AutomobileRepository extends ServiceEntityRepository implements AutomobileRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Automobile::class);
    }


    public function save(Automobile $automobile): void
    {
        $this->_em->persist($automobile);
        $this->_em->flush();
    }
}