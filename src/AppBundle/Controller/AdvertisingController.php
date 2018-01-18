<?php
/**
 * Created by PhpStorm.
 * User: toma4
 * Date: 16.01.2018
 * Time: 12:24
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Advertising;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertisingController extends Controller
{

    public function placeAction(int $place){
        $entityMenager = $this->getDoctrine()->getManager();
        $adverts = $entityMenager->getRepository(Advertising::class)->findBy(["place" => $place]);
        $index = rand(0, count($adverts) - 1);
        $advertising = $adverts[$index];

        return $this->render('Advertising/place_'.$place.'.html.twig', ["advertising" => $advertising]);
    }
}