<?php

declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Entity\Owner\Owner;
use AppBundle\Repository\Owner\OwnerRepositoryInterface;

final class ImportOwnersDataService
{
    /**
     * @var OwnerRepositoryInterface
     */
    private $ownerRepository;

    /**
     * @var AddAutomobileService
     */
    private $addAutomobileService;

    public function __construct(
        OwnerRepositoryInterface $ownerRepository,
        AddAutomobileService $addAutomobileService

    ) {
        $this->ownerRepository = $ownerRepository;
        $this->addAutomobileService = $addAutomobileService;
    }

    public function importOwnerData(array $owners, array $automobiles): string
    {
        $invalidStrings = '';

        foreach ($owners as $owner) {
            try {
                if ($this->ownerRepository->findOwners(
                    $owner['name'],
                    $owner['surname'],
                )
                ) {
                    foreach (
                        $this->ownerRepository->findOwners(
                            $owner['name'],
                            $owner['surname'],
                        ) as $own
                    ) {
                        $own->setEmail($owner['email']);

                        $this->addAutomobileService->addAutomobile(
                            $own,
                            $owner,
                            $automobiles,
                        );

                        $this->ownerRepository->save($own);
                    }
                } else {
                    $own = new Owner();
                    $own->setName($owner['name']);
                    $own->setSurname($owner['surname']);
                    $own->setEmail($owner['email']);

                    $this->addAutomobileService->addAutomobile(
                        $own,
                        $owner,
                        $automobiles,
                    );

                    $this->ownerRepository->save($own);
                }
            } catch (\Exception $exception) {
                $invalidStrings .= sprintf(
                    " \nname: %s, surname: %s, email: %s;",
                    $owner['name'],
                    $owner['surname'],
                    $owner['email'],
                );
            }
        }

        return $invalidStrings;
    }
}
