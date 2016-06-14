<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SearchForm;
use AppBundle\Form\SearchFormType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * search projet controller.
 *
 * @Route("/")
 */
class SearchController extends Controller
{


    /**
     * @Route("search", name="search")
     */
    public function searchAction(Request $request)
    {
        $searchForm = new SearchForm();
        $form = $this->createForm(SearchFormType::class, $searchForm, ['action'=> $this->generateUrl('search'),'attr'=>['class'=>'navbar-form']]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           return $this->redirectToRoute('projet', array('id' => $searchForm->getId()));
        }

        $result= $this->render('form/search.html.twig', array(
            'form' => $form->createView(),
        ));
        return $result;

    }
    /**
     * @Route("/search/auto/{q}", name="search_autocomplete", condition="request.isXmlHttpRequest()", defaults={"q" = ""})
     */
    public function indexAction(Request $request, $q)
    {
        /** @var $em  EntityManager */
        $em = $this->getDoctrine()->getManager();

        if ($q != '') {
            $query = $em->createQuery('SELECT p.name, p.id FROM AppBundle:Projet p WHERE p.name LIKE :query')
                ->setParameter(':query', '%' . $q . '%');
        } else {
            $query = $em->createQuery('SELECT p.name, p.id FROM AppBundle:Projet p');

        }
        $data = $query->setMaxResults(50)->getArrayResult();
        return $this->json($data);
    }

}
