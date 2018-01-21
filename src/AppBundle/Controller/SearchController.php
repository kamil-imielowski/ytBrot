<?php
/**
 * Created by PhpStorm.
 * User: toma4
 * Date: 13.12.2017
 * Time: 11:37
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Channel;
use AppBundle\Entity\Movie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{

    public function showAction(){
        $form = $this->createFormBuilder(null)
            ->setAction("/search")
            ->add('query', TextType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        return $this->render('search/searchForm.html.twig', ["searchForm" => $form->createView()]);
    }

    /**
     * @Route("/search", name="search")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchAction(Request $request){
        $form = $request->get("form");
        $results = array();

        $entityMenager = $this->getDoctrine()->getManager();
        // obsluga szukania tutaj:

        //kanały
        $results['channels'] = $entityMenager->getRepository(Channel::class)->findByNameLike($form['query']);

        //filmy
        $results['movies'] =  $entityMenager->getRepository(Movie::class)->findByNameLike($form['query']);

        //end

        return $this->render("search/search.html.twig", ["query" => $form['query'], 'reults' => $results]);
    }


}