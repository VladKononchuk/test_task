<?php

declare(strict_types=1);

namespace AppBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AdminController
{
    /**
     * @Route("/admin", name="easyadmin")
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction(
            $request
        );
    }
}