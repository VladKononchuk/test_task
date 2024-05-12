<?php

declare(strict_types=1);

namespace AppBundle\Repository\Owner;

use AppBundle\Entity\Owner;

;

interface OwnerRepositoryInterface
{
    public function save(Owner $automobile): void;
}