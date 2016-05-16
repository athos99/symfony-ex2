<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Utils\Util;
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
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').' for admin',
            ]
        );
    }


    /**
     * @Route("/test1", name="admin_test1")
     */
    public function test1Action(Request $request)
    {

        $data = Util::loadExcel('rubrique.xlsx');
        $root = [];
        foreach( $data as $record) {

        }
        $em = $this->getDoctrine()->getManager();

        $response = new Response('Hello ', Response::HTTP_OK);

        return $response;
    }


}
