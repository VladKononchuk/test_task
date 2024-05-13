<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Automobile;
use AppBundle\Repository\Automobile\AutomobileRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    private $autoRep;
    public function __construct(AutomobileRepositoryInterface $automobileRepository)
    {
        $this->autoRep = $automobileRepository;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request): Response
    {
        $a = new Automobile();
        $a->setName('d');
        $a->setBrand('dd');
        $a->setMileage(4);

        $b =

        $this->autoRep->save($a);
        // replace this example code with whatever you need
        return $this->render('base.html.twig');
    }
}