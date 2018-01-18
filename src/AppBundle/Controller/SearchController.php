<?php
/**
 * Created by PhpStorm.
 * User: toma4
 * Date: 13.12.2017
 * Time: 11:37
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{

    /**
     * @Route("/szukaj", name="app_search")
     */
    public function showAction(){
        $form = $this->createForm(new GroupingType());
        return $this->render('search/search.html.twig', ["form" => $form]);
    }
}