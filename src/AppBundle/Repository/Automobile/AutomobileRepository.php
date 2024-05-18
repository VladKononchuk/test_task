<?php

namespace AppBundle\Repository\Automobile;

use AppBundle\Entity\Automobile\Automobile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Automobile>
 */
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

    public function findAutomobiles(string $name, string $brand): array
    {
        return $this->findBy(['name' => $name, 'brand' => $brand]);
    }
}
