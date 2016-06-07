<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SearchForm;
use AppBundle\Form\SearchFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * admin default controller.
 *
 * @Route("/")
 */
class SearchController extends Controller
{


    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $searchForm = new SearchForm();
        $form = $this->createForm(SearchFormType::class, $searchForm, ['attr'=>['class'=>'navbar-form']]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
//        return $this->redirectToRoute('tache_edit', array('id' => $tache->getId()));
        }

        $result= $this->render('form/search.html.twig', array(
            'form' => $form->createView(),
        ));
        return $result;

    }


}
