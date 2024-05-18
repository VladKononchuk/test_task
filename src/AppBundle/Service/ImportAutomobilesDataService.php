<?php

declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Entity\Automobile\Automobile;
use AppBundle\Entity\Automobile\ValueObject\AutomobileStringValidation;
use AppBundle\Repository\Automobile\AutomobileRepositoryInterface;

final class ImportAutomobilesDataService
{
    private $automobileRepository;

    public function __construct(
        AutomobileRepositoryInterface $automobileRepository
    ) {
        $this->automobileRepository = $automobileRepository;
    }

    public function importAutomobileData(): string
    {
        $contentOfAutomobile = file_get_contents(
            '/home/vladislav/test_task/Automobile.json'
        );
        $automobiles = json_decode($contentOfAutomobile, true);
        $invalidStrings = '';

        foreach ($automobiles as $automobile) {
            try {
                if ($this->automobileRepository->findAutomobiles(
                    $automobile['name'],
                    $automobile['brand']
                )
                ) {
                    foreach (
                        $this->automobileRepository->findAutomobiles(
                            $automobile['name'],
                            $automobile['brand']
                        ) as $auto
                    ) {
                        $auto->setName(
                            new AutomobileStringValidation($automobile['name'])
                        );
                        $this->automobileRepository->save($auto);
                    }
                } else {
                    $auto = new Automobile();
                    $auto->setName(
                        new AutomobileStringValidation($automobile['name'])
                    );
                    $auto->setBrand(
                        new AutomobileStringValidation($automobile['brand'])
                    );
                    $auto->setMileage($automobile['mileage']);

                    $this->automobileRepository->save($auto);
                }
            } catch (\Exception $exception) {
                $invalidStrings .= sprintf(
                    "\nname: %s, brand: %s, mileage: %s;",
                    $automobile['name'],
                    $automobile['brand'],
                    $automobile['mileage']
                );
            }
        }

        return $invalidStrings;
    }
}
