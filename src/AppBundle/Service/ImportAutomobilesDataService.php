<?php

declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Entity\Automobile\Automobile;
use AppBundle\Repository\Automobile\AutomobileRepositoryInterface;

final class ImportAutomobilesDataService
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

    public function importAutomobileData(array $automobiles): string
    {
        $invalidStrings = '';

        foreach ($automobiles as $automobile) {
            try {
                if ($this->automobileRepository->findAutomobiles(
                    $automobile['name'],
                    $automobile['brand'],
                )
                ) {
                    foreach (
                        $this->automobileRepository->findAutomobiles(
                            $automobile['name'],
                            $automobile['brand'],
                        ) as $auto
                    ) {
                        $auto->setMileage($automobile['mileage']);
                        $this->automobileRepository->save($auto);
                    }
                } else {
                    $auto = new Automobile();
                    $auto->setName($automobile['name']);
                    $auto->setBrand($automobile['brand']);
                    $auto->setMileage($automobile['mileage']);

                    $this->automobileRepository->save($auto);
                }
            } catch (\Exception $exception) {
                $invalidStrings .= sprintf(
                    "\nname: %s, brand: %s, mileage: %s;",
                    $automobile['name'],
                    $automobile['brand'],
                    $automobile['mileage'],
                );
            }
        }

        return $invalidStrings;
    }
}
