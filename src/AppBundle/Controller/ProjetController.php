<?php

namespace AppBundle\Controller;

use AppBundle\Model\DataBase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * search projet controller.
 *
 * @Route("/projet")
 */
class ProjetController extends Controller
{
    /**
     * @Route("/{i}", name="projet", requirements={"id" = "\d+"}, defaults={"id" = -1})
     */
    public function indexAction(Request $request, $id)
    {
$x=$this->getDoctrine();
        $dataBase = DataBase::instance($this->getDoctrine());

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
