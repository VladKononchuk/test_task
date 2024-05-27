<?php

declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Entity\Owner\Owner;
use AppBundle\Repository\Automobile\AutomobileRepositoryInterface;

final class AddAutomobileService
{
    /**
     * @var AutomobileRepositoryInterface
     */
    private $automobileRepository;

    public function __construct(
        AutomobileRepositoryInterface $automobileRepository
    ) {
        $this->automobileRepository = $automobileRepository;
    }

    public function addAutomobile(
        Owner $own,
        array $owner,
        array $automobiles
    ): void {
        if (!empty($owner['Automobile'])) {
            foreach ($owner['Automobile'] as $autoId) {
                $automobile
                    = $this->automobileRepository->findAutomobiles(
                    $automobiles[$autoId]['name'],
                    $automobiles[$autoId]['brand'],
                );
                if (!empty($automobile)) {
                    foreach ($automobile as $auto) {
                        $own->addAutomobile($auto);
                    }
                }
            }
        }
    }
}
