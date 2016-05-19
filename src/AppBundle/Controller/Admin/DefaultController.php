<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Cfc;
use AppBundle\Repository\CfcRepository;
use AppBundle\Utils\Util;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * admin default controller.
 *
 * @Route("/admin")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="admin_homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(
            'default/index.html.twig',
            [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . ' for admin',
            ]
        );
    }


    /**
     * @Route("/test1", name="admin_test1")
     */
    public function test1Action(Request $request)
    {

        $data = Util::loadExcel('cfc.xlsx');
        $tree = Util::buildTree($data, '',
            function ($element) {
                return $element['ref'];
            },
            function ($element) {
                return substr($element['ref'], 0, strripos($element['ref'], '.'));
            });

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();



        /** @var CfcRepository $repo */
        $repo = $em->getRepository('AppBundle:Cfc');
        $repo->saveDataTree($tree);

        $htmlTree = $repo->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* false: load all children, true: only direct */
            array(
                'decorate' => true,
                'representationField' => 'slug',
                'html' => true
            )
        );
        return $this->render(
            'admin/test1.html.twig',
            [
                'tree' => $htmlTree,
            ]
        );


//        return  new Response('Hello ', Response::HTTP_OK);
    }


}
