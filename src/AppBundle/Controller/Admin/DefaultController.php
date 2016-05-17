<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Rubrique;
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

        $data = Util::loadExcel('rubrique.xlsx');
        $tree = Util::buildTree($data, '',
            function ($element) {
                return $element['ref'];
            },
            function ($element) {
                return substr($element['ref'], 0, strripos($element['ref'], '.'));
            });

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();


        $query = $em->createQuery(
            'DELETE FROM AppBundle:Rubrique');
        $query->execute();


        $rubrique = new Rubrique();
        $rubrique->setName('root');
        $rubrique->setDescription('bla bla bla');
        $rubrique->setRef( null);
        $em->persist($rubrique);
        $em->flush();

        $this->persistTree( $tree, $rubrique, $em);

        $response = new Response('Hello ', Response::HTTP_OK);


        $repo = $em->getRepository('AppBundle:Rubrique');

        $htmlTree = $repo->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* false: load all children, true: only direct */
            array(
                'decorate' => true,
                'representationField' => 'slug',
                'html' => true
            )
        );
        echo $htmlTree;
        return $response;
    }

    protected function persistTree( $tree, $parent,$em) {
      foreach( $tree as &$elem) {
         $rubrique = new Rubrique();
         $rubrique->setName(isset($elem['name']) ? $elem['name'] : null);
         $rubrique->setDescription(isset($elem['description']) ? $elem['description'] : null);
         $rubrique->setRef(isset($elem['ref']) ? $elem['ref'] : null);
         $rubrique->setParent($parent);
         $em->persist($rubrique);
          if (!empty($elem['children'])) {
              $this->persistTree($elem['children'], $rubrique,$em);
          }
      }
      $em->flush();
    }

}
