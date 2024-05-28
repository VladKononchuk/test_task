<?php

declare(strict_types=1);

namespace AppBundle\Event;

use AppBundle\Entity\Automobile\Automobile;
use Symfony\Component\EventDispatcher\Event;

final class AutomobileChangesEvent extends Event
{
    public const NAME = 'automobile.change';

    /**
     * @var Automobile
     */
    private $automobile;

    public function getAutomobile(): Automobile
    {
        return $this->automobile;
    }

    public function setAutomobile($automobile): void
    {
        $this->automobile = $automobile;
    }
}
