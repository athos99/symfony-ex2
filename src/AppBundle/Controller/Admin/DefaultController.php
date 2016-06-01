<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\RechercheProjet;
use AppBundle\Entity\TestForm;
use AppBundle\Form\RechercheProjetType;

use AppBundle\Form\TestFormType;
use AppBundle\Repository\CfcRepository;
use AppBundle\Repository\ProjetRepository;
use AppBundle\Repository\TacheRepository;
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
        return $this->render('admin/index.html.twig', []);
    }


    /**
     * @Route("/xclcfc", name="admin_xcl_cfc")
     */
    public function xclCfcAction(Request $request)
    {

        $data = Util::loadExcel('cfc.xlsx');
        $tree = Util::buildTree(
            $data,
            '',
            function ($element) {
                return $element['ref'];
            },
            function ($element) {
                return substr($element['ref'], 0, strripos($element['ref'], '.'));
            }
        );

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
                'html' => true,
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

    /**
     * @Route("/xclprojet", name="admin_xcl_projet")
     */
    public function xclProjetAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $data = Util::loadExcel('projet.xlsx');

        /** @var ProjetRepository $repo */
        $repo = $em->getRepository('AppBundle:Projet');
        $repo->saveData($data);

        // replace this example code with whatever you need
        return $this->render('admin/index.html.twig', []);

    }

    /**
     * @Route("/xcltache", name="admin_xcl_tache")
     */
    public function xclTacheAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $data = Util::loadExcel('tache.xlsx');


        /** @var TacheRepository $repo */
        $repo = $em->getRepository('AppBundle:Tache');
        $repo->saveData($data);

        // replace this example code with whatever you need
        return $this->render('admin/index.html.twig', []);

    }



    /**
     * @Route("/test_form", name="admin_test_form")
     */
    public function testFormAction(Request $request)
    {
        $testForm = new TestForm();
        $form = $this->createForm(TestFormType::class, $testForm);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            var_dump($testForm);
//        return $this->redirectToRoute('tache_edit', array('id' => $tache->getId()));
        }

        $f= $form->createView();
        return $this->render('default/form.html.twig', array(
//            'form' => $form->createView(),
            'form' => $f,
        ));


    }



    /**
     * @Route("/recherche_projet", name="admin_recherche_projet")
     */
    public function searchProjetAction(Request $request)
    {
        $rechercheProjet = new RechercheProjet();
        $form = $this->createForm(RechercheProjetType::class, $rechercheProjet);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($rechercheProjet);
//        return $this->redirectToRoute('tache_edit', array('id' => $tache->getId()));
        }

        return $this->render('default/form.html.twig', array(
            'form' => $form->createView(),
        ));


    }


}
