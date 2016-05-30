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

class DefaultController extends Controller
{
    /**
     * @Route("auto/{$q}", name="ajax_autocomplete", condition="request.isXmlHttpRequest())
     */
    public function indexAction(Request $request, $q)
    {
/** @var $em  EntityManager */
        $em = $this->getDoctrine()->getManager();
        $data = $em->createQuery(
            '
SELECT p
FROM AppBundle:Projet p.name
WHERE p.name LIKE :query'
        )->execute([':query'=>'%'.$q.'%'], Query::HYDRATE_SINGLE_SCALAR);




        return JsonResponse::create($data);
    }
}
