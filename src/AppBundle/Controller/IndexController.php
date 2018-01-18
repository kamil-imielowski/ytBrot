<?php
/**
 * Created by PhpStorm.
 * User: toma4
 * Date: 13.12.2017
 * Time: 10:40
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

    /**
     * @Route("/", name="app_index")
     */
    public function showAction(){
        return $this->render('index/index.html.twig');
    }

}