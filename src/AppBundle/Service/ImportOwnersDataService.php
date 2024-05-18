<?php

declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Entity\Owner\Owner;
use AppBundle\Entity\Owner\ValueObject\Email;
use AppBundle\Entity\Owner\ValueObject\OwnerStringValidation;
use AppBundle\Repository\Owner\OwnerRepositoryInterface;

final class ImportOwnersDataService
{
    private $ownerRepository;

    public function __construct(OwnerRepositoryInterface $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;
    }

    public function importOwnerData(): string
    {
        $contentOfOwner = file_get_contents(
            '/home/vladislav/test_task/Owner.json'
        );
        $owners = json_decode($contentOfOwner, true);
        $invalidStrings = '';

        foreach ($owners as $owner) {
            try {
                if ($this->ownerRepository->findOwners(
                    $owner['name'],
                    $owner['surname']
                )
                ) {
                    foreach (
                        $this->ownerRepository->findOwners(
                            $owner['name'],
                            $owner['surname']
                        ) as $own
                    ) {
                        $own->setEmail(
                            new Email($owner['email'])
                        );
                        $this->ownerRepository->save($own);
                    }
                } else {
                    $own = new Owner();
                    $own->setName(new OwnerStringValidation($owner['name']));
                    $own->setSurname(
                        new OwnerStringValidation($owner['surname'])
                    );
                    $own->setEmail(new Email($owner['email']));

                    $this->ownerRepository->save($own);
                }
            } catch (\Exception $exception) {
                $invalidStrings .= sprintf(
                    " \nname: %s, surname: %s, email: %s;",
                    $owner['name'],
                    $owner['surname'],
                    $owner['email']
                );
            }
        }

        return $invalidStrings;
    }
}
