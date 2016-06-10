<?php

namespace AppBundle\Controller;

use AppBundle\Model\DataBase;
use AppBundle\Model\Projet;
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
     * @Route("/{id}", name="projet", requirements={"id" = "\d+"}, defaults={"id" = -1})
     */
    public function indexAction(Request $request, $id)
    {
        /** @var \AppBundle\Service\DataBase $dataBase */
        $dataBase = $this->container->get('app.database');

        /** @var Projet $projet */
        $projet = $this->container->get('app.model.projet');


        $data = $projet->loadProjet($id);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
