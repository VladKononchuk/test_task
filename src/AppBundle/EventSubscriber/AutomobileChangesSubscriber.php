<?php

declare(strict_types=1);

namespace AppBundle\EventSubscriber;

use AppBundle\Event\AutomobileChangesEvent;
use AppBundle\Service\Mailer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class AutomobileChangesSubscriber implements EventSubscriberInterface
{
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(
        Mailer $mailer
    ) {
        $this->mailer = $mailer;
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [AutomobileChangesEvent::NAME => 'AutomobileChange'];
    }

    public function AutomobileChange(): void
    {
        $this->mailer->send();
    }
}
