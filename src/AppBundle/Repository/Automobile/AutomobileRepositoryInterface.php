<?php

declare(strict_types=1);

namespace AppBundle\Repository\Automobile;

use AppBundle\Entity\Automobile\Automobile;

interface AutomobileRepositoryInterface
{
    public function save(Automobile $automobile): void;

    /**
     * @return Automobile[]
     */
    public function findAutomobiles(string $name, string $brand): array;
}
