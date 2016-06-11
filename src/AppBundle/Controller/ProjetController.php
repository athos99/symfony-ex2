<?php

namespace AppBundle\Controller;

use AppBundle\Helper\Application;
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
        /** @var Projet $projetModel */
        $projetModel = $this->container->get('app.model.projet');

        $projet = $projetModel->loadProjet($id);
        
        $logger = Application::getLogger();
        $logger->info('I just got the logger');
        $logger->error('An error occurred');


        // replace this example code with whatever you need
        return $this->render('projet/edit.html.twig', [
            'projet' => $projet,
        ]);
    }
}
