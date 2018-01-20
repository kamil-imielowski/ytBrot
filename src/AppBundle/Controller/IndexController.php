<?php
/**
 * Created by PhpStorm.
 * User: toma4
 * Date: 13.12.2017
 * Time: 10:40
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Movie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

    /**
     * @Route("/", name="app_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(){
        $entityMenager = $this->getDoctrine()->getManager();
        $movies = $entityMenager->getRepository(Movie::class)->getLastMovies(15);

        return $this->render('index/index.html.twig', ["movies" => $movies]);
    }

}