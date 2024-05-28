<?php

declare(strict_types=1);

namespace AppBundle\Controller\Admin;

use AppBundle\Event\AutomobileChangesEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController;
use Exception;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DashboardController extends AdminController
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @Route("/admin", name="easyadmin")
     *
     * @return RedirectResponse|Response
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * @return mixed
     * @throws Exception
     */
    protected function executeDynamicMethod(
        $methodNamePattern,
        array $arguments = []
    ) {
        if ($this->entity['name'] === 'Automobile'
            && (mb_substr(
                    $methodNamePattern,
                    0,
                    7,
                ) === 'persist'
                || mb_substr($methodNamePattern, 0, 6) === 'update')
        ) {
            $automobileChanges = new AutomobileChangesEvent();
            $this->eventDispatcher->dispatch(
                AutomobileChangesEvent::NAME,
                $automobileChanges,
            );
        }

        return parent::executeDynamicMethod(
            $methodNamePattern,
            $arguments,
        );
    }
}
