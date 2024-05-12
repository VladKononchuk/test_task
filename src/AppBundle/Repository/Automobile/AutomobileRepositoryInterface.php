<?php

declare(strict_types=1);

namespace AppBundle\Repository\Automobile;

use AppBundle\Entity\Automobile;

interface AutomobileRepositoryInterface
{
    public function save(Automobile $automobile): void;
}