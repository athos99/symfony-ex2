<?php

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Ajax controller.
 *
 * @Route("/ajax")
 */
class AjaxController extends Controller
{
    /**
     * @Route("/auto/{q}", name="ajax_autocomplete", condition="request.isXmlHttpRequest()")
     * @Route("/auto/{q}", name="ajax_autocomplete")
     */
    public function indexAction(Request $request, $q)
    {
        /** @var $em  EntityManager */
        $em = $this->getDoctrine()->getManager();
        $data = $em->createQuery('SELECT p.name, p.id FROM AppBundle:Projet p WHERE p.name LIKE :query')
        ->setParameter(':query' , '%' . $q . '%')
        ->getArrayResult();

        return JsonResponse::create($data);
    }
}
